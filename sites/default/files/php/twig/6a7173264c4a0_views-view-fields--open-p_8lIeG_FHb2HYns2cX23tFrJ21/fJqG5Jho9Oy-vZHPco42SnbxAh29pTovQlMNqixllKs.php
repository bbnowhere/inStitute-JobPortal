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

/* themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/views/views-view-fields--open-positions--page-1.html.twig */
class __TwigTemplate_6b30807b8cc9a3e4d0f938d4f3e38573 extends Template
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
        // line 1
        yield "<div class=\"card shadow h-100 openpositions\">
  <div class=\"card-body\">
    <h5 class=\"card-title\">";
        // line 3
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["fields"] ?? null), "title", [], "any", false, false, true, 3), "content", [], "any", false, false, true, 3), "html", null, true);
        yield "</h5>
<p class=\"mb-1\"><strong>Advertisement No:</strong> ";
        // line 4
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["row"] ?? null), "_entity", [], "any", false, false, true, 4), "field_advertisement_number", [], "any", false, false, true, 4), "entity", [], "any", false, false, true, 4), "label", [], "any", false, false, true, 4), "html", null, true);
        yield "</p>    <p class=\"mb-1\"><strong>Job Code:</strong> ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["fields"] ?? null), "field_job_code", [], "any", false, false, true, 4), "content", [], "any", false, false, true, 4), "html", null, true);
        yield "</p>
    <p class=\"mb-1\"><strong>Department:</strong> ";
        // line 5
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["fields"] ?? null), "field_department", [], "any", false, false, true, 5), "content", [], "any", false, false, true, 5), "html", null, true);
        yield "</p>
    <p class=\"mb-1\"><strong>Vacancies:</strong> ";
        // line 6
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["fields"] ?? null), "field_number_of_vacancies", [], "any", false, false, true, 6), "content", [], "any", false, false, true, 6), "html", null, true);
        yield "</p>
    <p class=\"mb-1\"><strong>Last Date:</strong> ";
        // line 7
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["fields"] ?? null), "field_last_date", [], "any", false, false, true, 7), "content", [], "any", false, false, true, 7), "html", null, true);
        yield "</p>
    ";
        // line 8
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["fields"] ?? null), "field_category", [], "any", false, false, true, 8), "content", [], "any", false, false, true, 8)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 9
            yield "      <p class=\"mb-1\"><strong>Category:</strong> ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["fields"] ?? null), "field_category", [], "any", false, false, true, 9), "content", [], "any", false, false, true, 9), "html", null, true);
            yield "</p>
    ";
        }
        // line 11
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["fields"] ?? null), "field_pwd_categories", [], "any", false, false, true, 11), "content", [], "any", false, false, true, 11)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 12
            yield "      <p class=\"mb-1\"><strong>PWD Category:</strong> ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["fields"] ?? null), "field_pwd_categories", [], "any", false, false, true, 12), "content", [], "any", false, false, true, 12), "html", null, true);
            yield "</p>
    ";
        }
        // line 14
        yield "    ";
        // line 15
        yield "
";
        // line 16
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["apply_markup"] ?? null), "html", null, true);
        yield "
  </div>
</div>";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["fields", "row", "apply_markup"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/views/views-view-fields--open-positions--page-1.html.twig";
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
        return array (  92 => 16,  89 => 15,  87 => 14,  81 => 12,  78 => 11,  72 => 9,  70 => 8,  66 => 7,  62 => 6,  58 => 5,  52 => 4,  48 => 3,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"card shadow h-100 openpositions\">
  <div class=\"card-body\">
    <h5 class=\"card-title\">{{ fields.title.content }}</h5>
<p class=\"mb-1\"><strong>Advertisement No:</strong> {{ row._entity.field_advertisement_number.entity.label }}</p>    <p class=\"mb-1\"><strong>Job Code:</strong> {{ fields.field_job_code.content }}</p>
    <p class=\"mb-1\"><strong>Department:</strong> {{ fields.field_department.content }}</p>
    <p class=\"mb-1\"><strong>Vacancies:</strong> {{ fields.field_number_of_vacancies.content }}</p>
    <p class=\"mb-1\"><strong>Last Date:</strong> {{ fields.field_last_date.content }}</p>
    {% if fields.field_category.content %}
      <p class=\"mb-1\"><strong>Category:</strong> {{ fields.field_category.content }}</p>
    {% endif %}
    {% if fields.field_pwd_categories.content %}
      <p class=\"mb-1\"><strong>PWD Category:</strong> {{ fields.field_pwd_categories.content }}</p>
    {% endif %}
    {# Application Type Logic #}

{{ apply_markup }}
  </div>
</div>", "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/views/views-view-fields--open-positions--page-1.html.twig", "/var/www/html/jobportal/themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/views/views-view-fields--open-positions--page-1.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 8];
        static $filters = ["escape" => 3];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
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
