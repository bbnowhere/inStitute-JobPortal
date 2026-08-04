<?php

namespace Drupal\instemjobportal\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Drupal\node\Entity\Node;
use Dompdf\Dompdf;
use Dompdf\Options;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

class ApplicationPdfController extends ControllerBase {

  /**
   * Access control for PDF download.
   */
  public function access(Node $node, AccountInterface $account) {
    $roles = $account->getRoles();

    // 1. Anonymous users → No access
    if ($account->isAnonymous()) {
      return AccessResult::forbidden();
    }

    // 2. Admin + HR → Can download any user's PDF
    if (in_array('admin', $roles) || in_array('hr', $roles)) {
      return AccessResult::allowed()->cachePerPermissions();
    }

    // 3. Applicants can download ONLY their own application PDF
    if (in_array('applicant', $roles)) {
      if ($node->getOwnerId() == $account->id()) {
        return AccessResult::allowed()->cachePerUser();
      }
      return AccessResult::forbidden()->cachePerUser();
    }

    // 4. Everyone else denied
    return AccessResult::forbidden();
  }

  /**
   * PDF generation.
   */
  public function pdf(Node $node) {
    // Only allow personal_information content type.
    if ($node->bundle() !== 'personal_information') {
      throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
    }

    $build = \Drupal::entityTypeManager()
      ->getViewBuilder('node')
      ->view($node, 'pdf');

    $build['#theme'] = 'node__personal_information__pdf';
    $build['#pdf_mode'] = TRUE;

    $renderer = \Drupal::service('renderer');
    $html = $renderer->renderRoot($build);

    $options = new Options();
    $options->set('isRemoteEnabled', TRUE);
    $options->set('defaultFont', 'DejaVu Sans');

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    return new Response(
      $dompdf->output(),
      200,
      [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="application-' . $node->id() . '.pdf"',
      ]
    );
  }

}
