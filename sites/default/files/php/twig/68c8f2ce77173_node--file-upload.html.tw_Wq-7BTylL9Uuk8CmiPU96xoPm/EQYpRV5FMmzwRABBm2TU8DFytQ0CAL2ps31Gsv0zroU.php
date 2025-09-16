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

/* themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--file-upload.html.twig */
class __TwigTemplate_eb936cbe7f400da7f0c2e4eb7e2f8d6b extends Template
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
    File Uploads
  </div>
  <div class=\"card-body\">
    <table class=\"table table-bordered table-striped\">
      <tbody>
        <tr><th>Resume</th><td>";
        // line 9
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_resume", [], "any", false, false, true, 9), "html", null, true);
        yield "</td></tr>
        <tr><th>PAN/Passport/DL/Voter</th><td>";
        // line 10
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_pan_passport_dl_voter", [], "any", false, false, true, 10), "html", null, true);
        yield "</td></tr>
        <tr><th>Experience Certificates</th><td>";
        // line 11
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_experience_certificates", [], "any", false, false, true, 11), "html", null, true);
        yield "</td></tr>
        <tr><th>Transaction Details</th><td>";
        // line 12
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_transaction_details", [], "any", false, false, true, 12), "html", null, true);
        yield "</td></tr>
        <tr><th>NOC Option</th><td>";
        // line 13
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_noc_option", [], "any", false, false, true, 13), "html", null, true);
        yield "</td></tr>
        <tr><th>NOC File</th><td>";
        // line 14
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_noc_file", [], "any", false, false, true, 14), "html", null, true);
        yield "</td></tr>
        <tr><th>Reservation Certificate</th><td>";
        // line 15
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_reservation_certificate", [], "any", false, false, true, 15), "html", null, true);
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
        return "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--file-upload.html.twig";
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
        return array (  77 => 15,  73 => 14,  69 => 13,  65 => 12,  61 => 11,  57 => 10,  53 => 9,  44 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# filepath: themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--file-upload.html.twig #}
<div class=\"card shadow mb-4\">
  <div class=\"card-header bg-primary text-white\">
    File Uploads
  </div>
  <div class=\"card-body\">
    <table class=\"table table-bordered table-striped\">
      <tbody>
        <tr><th>Resume</th><td>{{ content.field_resume }}</td></tr>
        <tr><th>PAN/Passport/DL/Voter</th><td>{{ content.field_pan_passport_dl_voter }}</td></tr>
        <tr><th>Experience Certificates</th><td>{{ content.field_experience_certificates }}</td></tr>
        <tr><th>Transaction Details</th><td>{{ content.field_transaction_details }}</td></tr>
        <tr><th>NOC Option</th><td>{{ content.field_noc_option }}</td></tr>
        <tr><th>NOC File</th><td>{{ content.field_noc_file }}</td></tr>
        <tr><th>Reservation Certificate</th><td>{{ content.field_reservation_certificate }}</td></tr>
      </tbody>
    </table>
  </div>
</div>", "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--file-upload.html.twig", "/var/www/html/jobportal/themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--file-upload.html.twig");
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
