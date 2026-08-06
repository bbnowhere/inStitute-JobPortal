<?php

namespace Drupal\job_import\Tests\Unit;

use Drupal\job_import\Service\JobImportService;
use PHPUnit\Framework\TestCase;

/**
 * Tests the job import service identity handling.
 */
final class JobImportServiceTest extends TestCase {

  /**
   * Ensures the importer uses the external job ID for matching.
   */
  public function testUsesExternalJobIdForIdentityAndNodeData(): void {
    require_once dirname(__DIR__, 3) . '/src/Service/JobImportService.php';

    $reflection = new \ReflectionClass(JobImportService::class);
    $service = $reflection->newInstanceWithoutConstructor();

    $extractExternalJobId = $reflection->getMethod('extractExternalJobId');
    $extractExternalJobId->setAccessible(true);

    $payload = [
      'fields' => [
        'field_external_job_id' => 'STAFF-2026-003',
        'field_job_code' => 'STAFF-2026-002',
      ],
    ];

    $this->assertSame('STAFF-2026-003', $extractExternalJobId->invoke($service, $payload));

    $buildNodeData = $reflection->getMethod('buildNodeData');
    $buildNodeData->setAccessible(true);
    $node_data = $buildNodeData->invoke($service, $payload, 'STAFF-2026-002', 'STAFF-2026-003');

    $this->assertSame('STAFF-2026-002', $node_data['field_job_code']);
    $this->assertSame('STAFF-2026-003', $node_data['field_external_job_id']);
  }

}
