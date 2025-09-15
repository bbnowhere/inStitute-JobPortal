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

/* themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--referee.html.twig */
class __TwigTemplate_5bd4fbe4563940d529938e3d58e60af8 extends Template
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
    Referees
  </div>
  <div class=\"card-body\">
    <table class=\"table table-bordered table-striped\">
      <thead>
        <tr>
          <th>Name</th>
          <th>Designation</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>";
        // line 19
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_referee1_name", [], "any", false, false, true, 19), "html", null, true);
        yield "</td>
          <td>";
        // line 20
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_referee1_designation", [], "any", false, false, true, 20), "html", null, true);
        yield "</td>
          <td>";
        // line 21
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_referee1_email", [], "any", false, false, true, 21), "html", null, true);
        yield "</td>
          <td>";
        // line 22
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_referee1_phone", [], "any", false, false, true, 22), "html", null, true);
        yield "</td>
          <td>";
        // line 23
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_referee1_address", [], "any", false, false, true, 23), "html", null, true);
        yield "</td>
        </tr>
        <tr>
          <td>";
        // line 26
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_referee2_name", [], "any", false, false, true, 26), "html", null, true);
        yield "</td>
          <td>";
        // line 27
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_referee2_designation", [], "any", false, false, true, 27), "html", null, true);
        yield "</td>
          <td>";
        // line 28
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_referee2_email", [], "any", false, false, true, 28), "html", null, true);
        yield "</td>
          <td>";
        // line 29
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_referee2_phone", [], "any", false, false, true, 29), "html", null, true);
        yield "</td>
          <td>";
        // line 30
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_referee2_address", [], "any", false, false, true, 30), "html", null, true);
        yield "</td>
        </tr>
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
        return "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--referee.html.twig";
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
        return array (  101 => 30,  97 => 29,  93 => 28,  89 => 27,  85 => 26,  79 => 23,  75 => 22,  71 => 21,  67 => 20,  63 => 19,  44 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# filepath: themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--referee.html.twig #}
<div class=\"card shadow mb-4\">
  <div class=\"card-header bg-primary text-white\">
    Referees
  </div>
  <div class=\"card-body\">
    <table class=\"table table-bordered table-striped\">
      <thead>
        <tr>
          <th>Name</th>
          <th>Designation</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{ content.field_referee1_name }}</td>
          <td>{{ content.field_referee1_designation }}</td>
          <td>{{ content.field_referee1_email }}</td>
          <td>{{ content.field_referee1_phone }}</td>
          <td>{{ content.field_referee1_address }}</td>
        </tr>
        <tr>
          <td>{{ content.field_referee2_name }}</td>
          <td>{{ content.field_referee2_designation }}</td>
          <td>{{ content.field_referee2_email }}</td>
          <td>{{ content.field_referee2_phone }}</td>
          <td>{{ content.field_referee2_address }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>", "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--referee.html.twig", "/var/www/html/jobportal/themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--referee.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = [];
        static $filters = ["escape" => 19];
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
