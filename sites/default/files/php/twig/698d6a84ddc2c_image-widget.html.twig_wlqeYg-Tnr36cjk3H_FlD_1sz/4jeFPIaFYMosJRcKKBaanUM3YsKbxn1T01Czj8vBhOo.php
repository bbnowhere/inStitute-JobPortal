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

/* themes/contrib/bootstrap/templates/content-edit/image-widget.html.twig */
class __TwigTemplate_3508e5cb0b08350cc80dffa5992bed98 extends Template
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
        // line 13
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("bootstrap/image-widget"), "html", null, true);
        yield "
<div";
        // line 14
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["attributes"] ?? null), "html", null, true);
        yield ">
  ";
        // line 15
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["data"] ?? null), "preview", [], "any", false, false, true, 15)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 16
            yield "    <div class=\"image-preview\">
      ";
            // line 17
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["data"] ?? null), "preview", [], "any", false, false, true, 17), "html", null, true);
            yield "
    </div>
  ";
        }
        // line 20
        yield "  <div class=\"image-widget-data\">
    ";
        // line 22
        yield "    ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter(($context["data"] ?? null), "preview"), "html", null, true);
        yield "
  </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes", "data"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap/templates/content-edit/image-widget.html.twig";
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
        return array (  66 => 22,  63 => 20,  57 => 17,  54 => 16,  52 => 15,  48 => 14,  44 => 13,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{#
/**
 * @file
 * Theme override for an image field widget.
 *
 * Available variables:
 * - attributes: HTML attributes for the containing element.
 * - data: Render elements of the image widget.
 *
 * @see template_preprocess_image_widget()
 */
#}
{{ attach_library('bootstrap/image-widget') }}
<div{{ attributes }}>
  {% if data.preview %}
    <div class=\"image-preview\">
      {{ data.preview }}
    </div>
  {% endif %}
  <div class=\"image-widget-data\">
    {# Render widget data without the image preview that was output already. #}
    {{ data|without('preview') }}
  </div>
</div>
", "themes/contrib/bootstrap/templates/content-edit/image-widget.html.twig", "/var/www/html/jobportal/themes/contrib/bootstrap/templates/content-edit/image-widget.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 15];
        static $filters = ["escape" => 13, "without" => 22];
        static $functions = ["attach_library" => 13];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'without'],
                ['attach_library'],
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
