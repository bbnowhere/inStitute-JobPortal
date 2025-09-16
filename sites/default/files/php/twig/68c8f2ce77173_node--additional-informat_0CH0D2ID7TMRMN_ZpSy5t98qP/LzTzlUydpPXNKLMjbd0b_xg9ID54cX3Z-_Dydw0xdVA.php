<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--additional-information.html.twig */
class __TwigTemplate_e4da926c9882dcb780e5a6603b7a0688 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 2
        yield "<div class=\"card shadow mb-4\">
  <div class=\"card-header bg-primary text-white\">
    Additional Information
  </div>
  <div class=\"card-body\">
    <table class=\"table table-bordered table-striped\">
      <tbody>
        <tr><th>Have you ever been involved in any administrative malpractice?</th><td>";
        // line 9
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_admin_malpractice", [], "any", false, false, true, 9), "html", null, true);
        yield "</td></tr>
        <tr><th>Malpractice Details</th><td>";
        // line 10
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_admin_malpractice_details", [], "any", false, false, true, 10), "html", null, true);
        yield "</td></tr>
        <tr><th>Have you been debarred or punished for adopting unfair means in any Examination by the Institution/Board/University?\t</th><td>";
        // line 11
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_debarred_unfair_means", [], "any", false, false, true, 11), "html", null, true);
        yield "</td></tr>
        <tr><th>Debarred Details</th><td>";
        // line 12
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_debarred_details", [], "any", false, false, true, 12), "html", null, true);
        yield "</td></tr>
        <tr><th>Were you ever discharged or dismissed from any previous employment?\t</th><td>";
        // line 13
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_discharged_employment", [], "any", false, false, true, 13), "html", null, true);
        yield "</td></tr>
        <tr><th>Discharged Employment Details</th><td>";
        // line 14
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_discharged_employment_d", [], "any", false, false, true, 14), "html", null, true);
        yield "</td></tr>
        <tr><th>Is there any pending or contemplated disciplinary proceedings against you?\t</th><td>";
        // line 15
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_disciplinary_proceedings", [], "any", false, false, true, 15), "html", null, true);
        yield "</td></tr>
        <tr><th>Disciplinary Proceedings Details</th><td>";
        // line 16
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_disciplinary_proceedings_d", [], "any", false, false, true, 16), "html", null, true);
        yield "</td></tr>
        <tr><th>Have you ever been involved in any financial irregularity?\t</th><td>";
        // line 17
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_financial_irregularity", [], "any", false, false, true, 17), "html", null, true);
        yield "</td></tr>
        <tr><th>Financial Irregularity Details</th><td>";
        // line 18
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_financial_irregularity_d", [], "any", false, false, true, 18), "html", null, true);
        yield "</td></tr>
        <tr><th>Time required for joining from the date of receiving offer letter (in days)\t</th><td>";
        // line 19
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_joining_time_days", [], "any", false, false, true, 19), "html", null, true);
        yield "</td></tr>
        <tr><th>Kindly describe significant contributions where you have worked?\ts</th><td>";
        // line 20
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_significant_contributions", [], "any", false, false, true, 20), "html", null, true);
        yield "</td></tr>
        <tr><th>What makes you suitable for the post you have applied? (Please describe in maximum 500 words)\t</th><td>";
        // line 21
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_suitability", [], "any", false, false, true, 21), "html", null, true);
        yield "</td></tr>
      </tbody>
    </table>
  </div>
</div>";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["content"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--additional-information.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  101 => 21,  97 => 20,  93 => 19,  89 => 18,  85 => 17,  81 => 16,  77 => 15,  73 => 14,  69 => 13,  65 => 12,  61 => 11,  57 => 10,  53 => 9,  44 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# filepath: themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--additional-information.html.twig #}
<div class=\"card shadow mb-4\">
  <div class=\"card-header bg-primary text-white\">
    Additional Information
  </div>
  <div class=\"card-body\">
    <table class=\"table table-bordered table-striped\">
      <tbody>
        <tr><th>Have you ever been involved in any administrative malpractice?</th><td>{{ content.field_admin_malpractice }}</td></tr>
        <tr><th>Malpractice Details</th><td>{{ content.field_admin_malpractice_details }}</td></tr>
        <tr><th>Have you been debarred or punished for adopting unfair means in any Examination by the Institution/Board/University?\t</th><td>{{ content.field_debarred_unfair_means }}</td></tr>
        <tr><th>Debarred Details</th><td>{{ content.field_debarred_details }}</td></tr>
        <tr><th>Were you ever discharged or dismissed from any previous employment?\t</th><td>{{ content.field_discharged_employment }}</td></tr>
        <tr><th>Discharged Employment Details</th><td>{{ content.field_discharged_employment_d }}</td></tr>
        <tr><th>Is there any pending or contemplated disciplinary proceedings against you?\t</th><td>{{ content.field_disciplinary_proceedings }}</td></tr>
        <tr><th>Disciplinary Proceedings Details</th><td>{{ content.field_disciplinary_proceedings_d }}</td></tr>
        <tr><th>Have you ever been involved in any financial irregularity?\t</th><td>{{ content.field_financial_irregularity }}</td></tr>
        <tr><th>Financial Irregularity Details</th><td>{{ content.field_financial_irregularity_d }}</td></tr>
        <tr><th>Time required for joining from the date of receiving offer letter (in days)\t</th><td>{{ content.field_joining_time_days }}</td></tr>
        <tr><th>Kindly describe significant contributions where you have worked?\ts</th><td>{{ content.field_significant_contributions }}</td></tr>
        <tr><th>What makes you suitable for the post you have applied? (Please describe in maximum 500 words)\t</th><td>{{ content.field_suitability }}</td></tr>
      </tbody>
    </table>
  </div>
</div>", "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--additional-information.html.twig", "/var/www/html/jobportal/themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--additional-information.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = [];
        static $filters = ["escape" => 9];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape'],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
