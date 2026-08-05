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

/* themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--job.html.twig */
class __TwigTemplate_011985e37071e811fcf9fd574cff4b17 extends Template
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
        // line 3
        yield "
<div class=\"card shadow-sm my-4\">
  <div class=\"card-header bg-primary text-white\">
    <h2 class=\"mb-0\">";
        // line 6
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["label"] ?? null), "html", null, true);
        yield "</h2>
  </div>
  <div class=\"card-body\">
    ";
        // line 9
        $context["pdf_files"] = CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_job_advertisement_upload", [], "any", false, false, true, 9);
        // line 10
        yield "    ";
        if (((Twig\Extension\CoreExtension::length($this->env->getCharset(), ($context["pdf_files"] ?? null)) > 0) && CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["pdf_files"] ?? null), 0, [], "any", false, true, true, 10), "entity", [], "any", true, true, true, 10))) {
            // line 11
            yield "      ";
            $context["pdf_file"] = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["pdf_files"] ?? null), 0, [], "any", false, false, true, 11), "entity", [], "any", false, false, true, 11);
            // line 12
            yield "      ";
            $context["pdf_url"] = $this->extensions['Drupal\Core\Template\TwigExtension']->getFileUrl(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["pdf_file"] ?? null), "uri", [], "any", false, false, true, 12), "value", [], "any", false, false, true, 12));
            // line 13
            yield "
      <div class=\"mb-4\">
        <h5 class=\"card-title\">Job Advertisement</h5>
        <embed src=\"";
            // line 16
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["pdf_url"] ?? null), "html", null, true);
            yield "\" type=\"application/pdf\" width=\"100%\" height=\"600px\" class=\"mb-3 border rounded\" />
        <a href=\"";
            // line 17
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["pdf_url"] ?? null), "html", null, true);
            yield "\" class=\"btn btn-success mt-2\" download>
          <i class=\"bi bi-download\"></i> Download PDF
        </a>
      </div>
    ";
        } else {
            // line 22
            yield "      <div class=\"mb-4\">
        <h5 class=\"card-title\">Job Description</h5>
        <div class=\"card-text\">
          ";
            // line 25
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_job_description", [], "any", false, false, true, 25), "html", null, true);
            yield "
        </div>
      </div>
    ";
        }
        // line 29
        yield "  </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["label", "node", "content"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--job.html.twig";
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
        return array (  95 => 29,  88 => 25,  83 => 22,  75 => 17,  71 => 16,  66 => 13,  63 => 12,  60 => 11,  57 => 10,  55 => 9,  49 => 6,  44 => 3,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# filepath: /var/www/html/jobportal/themes/custom/instem_theme/templates/node--job.html.twig #}
{# Beautiful Bootstrap SASS template for Job content type #}

<div class=\"card shadow-sm my-4\">
  <div class=\"card-header bg-primary text-white\">
    <h2 class=\"mb-0\">{{ label }}</h2>
  </div>
  <div class=\"card-body\">
    {% set pdf_files = node.field_job_advertisement_upload %}
    {% if pdf_files|length > 0 and pdf_files.0.entity is defined %}
      {% set pdf_file = pdf_files.0.entity %}
      {% set pdf_url = file_url(pdf_file.uri.value) %}

      <div class=\"mb-4\">
        <h5 class=\"card-title\">Job Advertisement</h5>
        <embed src=\"{{ pdf_url }}\" type=\"application/pdf\" width=\"100%\" height=\"600px\" class=\"mb-3 border rounded\" />
        <a href=\"{{ pdf_url }}\" class=\"btn btn-success mt-2\" download>
          <i class=\"bi bi-download\"></i> Download PDF
        </a>
      </div>
    {% else %}
      <div class=\"mb-4\">
        <h5 class=\"card-title\">Job Description</h5>
        <div class=\"card-text\">
          {{ content.field_job_description }}
        </div>
      </div>
    {% endif %}
  </div>
</div>
", "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--job.html.twig", "/var/www/html/jobportal/themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--job.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 9, "if" => 10];
        static $filters = ["escape" => 6, "length" => 10];
        static $functions = ["file_url" => 12];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape', 'length'],
                ['file_url'],
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
