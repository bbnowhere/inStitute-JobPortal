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

/* core/themes/claro/templates/navigation/menu-local-task.html.twig */
class __TwigTemplate_b343ff39e8a7384fad5e3a3447c53095 extends Template
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
        $context["classes"] = ["tabs__tab", (((        // line 21
($context["level"] ?? null) == "primary")) ? ("js-tab") : ("")), (((($tmp =         // line 22
($context["is_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("is-active") : ("")), (((($tmp =         // line 23
($context["is_active"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("js-active-tab") : (""))];
        // line 26
        yield "<li";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 26), "html", null, true);
        yield ">
  ";
        // line 27
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["link"] ?? null), "html", null, true);
        yield "
  ";
        // line 28
        if ((($context["is_active"] ?? null) && (($context["level"] ?? null) == "primary"))) {
            // line 29
            yield "    <button class=\"reset-appearance tabs__trigger\" type=\"button\" aria-label=\"";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Tabs display toggle"));
            yield "\" data-drupal-nav-tabs-trigger>
      ";
            // line 30
            yield from $this->load("@claro/../images/src/hamburger-menu.svg", 30)->unwrap()->yield($context);
            // line 31
            yield "    </button>
  ";
        }
        // line 33
        yield "</li>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["level", "is_active", "attributes", "link"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "core/themes/claro/templates/navigation/menu-local-task.html.twig";
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
        return array (  71 => 33,  67 => 31,  65 => 30,  60 => 29,  58 => 28,  54 => 27,  49 => 26,  47 => 23,  46 => 22,  45 => 21,  44 => 19,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{#
/**
 * @file
 * Theme override for a local task link.
 *
 * Available variables:
 * - attributes: HTML attributes for the wrapper element.
 * - is_active: Whether the task item is an active tab.
 * - link: A rendered link element.
 * - level: The menu level where the tab is rendered.
 *
 * Note: This template renders the content for each task item in
 * menu-local-tasks.html.twig.
 *
 * @see template_preprocess_menu_local_task()
 */
#}
{%
  set classes = [
    'tabs__tab',
    level == 'primary' ? 'js-tab',
    is_active ? 'is-active',
    is_active ? 'js-active-tab',
  ]
%}
<li{{ attributes.addClass(classes) }}>
  {{ link }}
  {% if is_active and level == 'primary' %}
    <button class=\"reset-appearance tabs__trigger\" type=\"button\" aria-label=\"{{ 'Tabs display toggle'|t }}\" data-drupal-nav-tabs-trigger>
      {% include \"@claro/../images/src/hamburger-menu.svg\" %}
    </button>
  {% endif %}
</li>
", "core/themes/claro/templates/navigation/menu-local-task.html.twig", "/var/www/html/jobportal/core/themes/claro/templates/navigation/menu-local-task.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 19, "if" => 28, "include" => 30];
        static $filters = ["escape" => 26, "t" => 29];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'include'],
                ['escape', 't'],
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
