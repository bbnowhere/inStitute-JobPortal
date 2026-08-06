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

/* core/modules/system/templates/admin-block.html.twig */
class __TwigTemplate_c43913d5e1c266c834ba15cec6e0cb4f extends Template
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
        // line 19
        $context["classes"] = ["panel"];
        // line 23
        yield "<div";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 23), "html", null, true);
        yield ">
  ";
        // line 24
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["block"] ?? null), "title", [], "any", false, false, true, 24)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 25
            yield "    <h3 class=\"panel__title\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["block"] ?? null), "title", [], "any", false, false, true, 25), "html", null, true);
            yield "</h3>
  ";
        }
        // line 27
        yield "  ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["block"] ?? null), "content", [], "any", false, false, true, 27)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 28
            yield "    <div class=\"panel__content\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["block"] ?? null), "content", [], "any", false, false, true, 28), "html", null, true);
            yield "</div>
  ";
        } elseif ((($tmp = CoreExtension::getAttribute($this->env, $this->source,         // line 29
($context["block"] ?? null), "description", [], "any", false, false, true, 29)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 30
            yield "    <div class=\"panel__description\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["block"] ?? null), "description", [], "any", false, false, true, 30), "html", null, true);
            yield "</div>
  ";
        }
        // line 32
        yield "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes", "block"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "core/modules/system/templates/admin-block.html.twig";
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
        return array (  75 => 32,  69 => 30,  67 => 29,  62 => 28,  59 => 27,  53 => 25,  51 => 24,  46 => 23,  44 => 19,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{#
/**
 * @file
 * Default theme implementation for an administrative block.
 *
 * Available variables:
 * - block: An array of information about the block, including:
 *   - show: A flag indicating if the block should be displayed.
 *   - title: The block title.
 *   - content: (optional) The content of the block.
 *   - description: (optional) A description of the block.
 *     (Description should only be output if content is not available).
 * - attributes: HTML attributes for the containing div element.
 *
 * @ingroup themeable
 */
#}
{%
  set classes = [
    'panel',
  ]
%}
<div{{ attributes.addClass(classes) }}>
  {% if block.title %}
    <h3 class=\"panel__title\">{{ block.title }}</h3>
  {% endif %}
  {% if block.content %}
    <div class=\"panel__content\">{{ block.content }}</div>
  {% elseif block.description %}
    <div class=\"panel__description\">{{ block.description }}</div>
  {% endif %}
</div>
", "core/modules/system/templates/admin-block.html.twig", "/var/www/html/jobportal/core/modules/system/templates/admin-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 19, "if" => 24];
        static $filters = ["escape" => 23];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
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
