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

/* modules/contrib/field_group_bootstrap/templates/field-group-bootstrap-card.html.twig */
class __TwigTemplate_03678cc3e627b13637a5e4b51af58b3b extends Template
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
        // line 18
        yield "<div id=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["id"] ?? null), "html", null, true);
        yield "\">
  <div";
        // line 19
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["attributes"] ?? null), "html", null, true);
        yield ">
    ";
        // line 20
        if ((($tmp = ($context["header"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 21
            yield "    <div class=\"card-header\">
      ";
            // line 22
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["header"] ?? null), "html", null, true);
            yield "
    </div>
    ";
        }
        // line 25
        yield "    ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["img"] ?? null), "html", null, true);
        yield "
    <div class=\"card-body\">
      ";
        // line 27
        if ((($tmp = ($context["title"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 28
            yield "        <h5 class=\"card-title\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["title"] ?? null), "html", null, true);
            yield "</h5>
      ";
        }
        // line 30
        yield "      <p class=\"card-text\">";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["children"] ?? null), "html", null, true);
        yield "</p>
    </div>
    ";
        // line 32
        if ((($tmp = ($context["footer"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 33
            yield "    <div class=\"card-footer text-muted\">
      ";
            // line 34
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["footer"] ?? null), "html", null, true);
            yield "
    </div>
    ";
        }
        // line 37
        yield "  </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["id", "attributes", "header", "img", "title", "children", "footer"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/contrib/field_group_bootstrap/templates/field-group-bootstrap-card.html.twig";
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
        return array (  95 => 37,  89 => 34,  86 => 33,  84 => 32,  78 => 30,  72 => 28,  70 => 27,  64 => 25,  58 => 22,  55 => 21,  53 => 20,  49 => 19,  44 => 18,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{#
/**
 * @file
 * Default theme implementation for a fieldgroup card element.
 *
 * Available variables:
 * - title: Title defined in formatter.
 * - children: The children of the group.
 * - attributes: A list of HTML attributes for the group wrapper.
 * - footer: Return HTML footer.
 * - header: Title of the group.
 *
 * @see template_preprocess_field_group_bootstrap_card()
 *
 * @ingroup themeable
 */
#}
<div id=\"{{ id }}\">
  <div{{ attributes }}>
    {% if header %}
    <div class=\"card-header\">
      {{ header }}
    </div>
    {% endif %}
    {{ img }}
    <div class=\"card-body\">
      {% if title %}
        <h5 class=\"card-title\">{{ title }}</h5>
      {% endif %}
      <p class=\"card-text\">{{ children }}</p>
    </div>
    {% if footer %}
    <div class=\"card-footer text-muted\">
      {{ footer }}
    </div>
    {% endif %}
  </div>
</div>
", "modules/contrib/field_group_bootstrap/templates/field-group-bootstrap-card.html.twig", "/var/www/html/jobportal/modules/contrib/field_group_bootstrap/templates/field-group-bootstrap-card.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 20];
        static $filters = ["escape" => 18];
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
