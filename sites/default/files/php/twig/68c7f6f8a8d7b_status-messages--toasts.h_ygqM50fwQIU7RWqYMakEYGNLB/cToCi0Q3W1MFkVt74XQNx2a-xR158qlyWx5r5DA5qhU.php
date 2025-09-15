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

/* themes/contrib/bootstrap/templates/misc/status-messages--toasts.html.twig */
class __TwigTemplate_8638998835ebdc635ebbb0d3c466d2e5 extends Template
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
        // line 28
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("bootstrap/toast"), "html", null, true);
        yield "

<div class=\"toast-container position-fixed top-0 end-0 p3\" aria-live=\"polite\" aria-atomic=\"true\" data-drupal-messages>

  ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["message_list"] ?? null));
        foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
            // line 33
            yield "    ";
            // line 34
            $context["classes"] = ["toast", "fade"];
            // line 39
            yield "    ";
            // line 40
            $context["heading"] = ["status" => t("Status message"), "error" => t("Error message"), "warning" => t("Warning message"), "info" => t("Informative message")];
            // line 47
            yield "    ";
            // line 48
            $context["color"] = ["status" => "#28a745", "warning" => "#dc3545", "error" => "#ffc107", "info" => "#17a2b8"];
            // line 55
            yield "    ";
            // line 56
            $context["role"] = ["status" => "status", "warning" => "alert", "error" => "alert", "info" => "info"];
            // line 63
            yield "    ";
            // line 64
            $context["autohide"] = ["status" => "true", "warning" => "false", "error" => "true", "info" => "false"];
            // line 71
            yield "    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 72
                yield "      <!-- Then put toasts within -->
      <div ";
                // line 73
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter(($context["attributes"] ?? null), "role", "aria-label"), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 73), "setAttribute", ["data-drupal-selector", "messages"], "method", false, false, true, 73), "setAttribute", ["role", (($_v0 = ($context["role"] ?? null)) && is_array($_v0) || $_v0 instanceof ArrayAccess && in_array($_v0::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v0[$context["type"]] ?? null) : CoreExtension::getAttribute($this->env, $this->source, ($context["role"] ?? null), $context["type"], [], "array", false, false, true, 73))], "method", false, false, true, 73), "setAttribute", ["data-bs-autohide", (($_v1 = ($context["autohide"] ?? null)) && is_array($_v1) || $_v1 instanceof ArrayAccess && in_array($_v1::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v1[$context["type"]] ?? null) : CoreExtension::getAttribute($this->env, $this->source, ($context["autohide"] ?? null), $context["type"], [], "array", false, false, true, 73))], "method", false, false, true, 73), "html", null, true);
                yield " aria-live=\"assertive\" aria-atomic=\"true\">
        <div class=\"toast-header\">
          <svg class=\"bd-placeholder-img rounded mr-2\" width=\"20\" height=\"20\" xmlns=\"http://www.w3.org/2000/svg\" preserveaspectratio=\"xMidYMid slice\" focusable=\"false\" role=\"img\">
            <rect ";
                // line 76
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "setAttribute", ["fill", (($_v2 = ($context["color"] ?? null)) && is_array($_v2) || $_v2 instanceof ArrayAccess && in_array($_v2::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v2[$context["type"]] ?? null) : CoreExtension::getAttribute($this->env, $this->source, ($context["color"] ?? null), $context["type"], [], "array", false, false, true, 76))], "method", false, false, true, 76), "html", null, true);
                yield " width=\"100%\" height=\"100%\"></rect>
          </svg>
          <strong class=\"me-auto\">";
                // line 78
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v3 = ($context["status_headings"] ?? null)) && is_array($_v3) || $_v3 instanceof ArrayAccess && in_array($_v3::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v3[$context["type"]] ?? null) : CoreExtension::getAttribute($this->env, $this->source, ($context["status_headings"] ?? null), $context["type"], [], "array", false, false, true, 78)), "html", null, true);
                yield "</strong>
          <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"toast\" aria-label=\"Close\"></button>
        </div>
        <div class=\"toast-body\">
          ";
                // line 82
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $context["message"], "html", null, true);
                yield "
        </div>
      </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 86
            yield "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['type'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 87
        yield "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["message_list", "attributes", "status_headings"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap/templates/misc/status-messages--toasts.html.twig";
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
        return array (  117 => 87,  111 => 86,  101 => 82,  94 => 78,  89 => 76,  83 => 73,  80 => 72,  75 => 71,  73 => 64,  71 => 63,  69 => 56,  67 => 55,  65 => 48,  63 => 47,  61 => 40,  59 => 39,  57 => 34,  55 => 33,  51 => 32,  44 => 28,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{#
/**
 * @file
 * Default theme implementation for status messages.
 *
 * Displays status, error, and warning messages, grouped by type.
 *
 * An invisible heading identifies the messages for assistive technology.
 * Sighted users see a colored box. See http://www.w3.org/TR/WCAG-TECHS/H69.html
 * for info.
 *
 * Add an ARIA label to the contentinfo area so that assistive technology
 * user agents will better describe this landmark.
 *
 * Available variables:
 * - message_list: List of messages to be displayed, grouped by type.
 * - status_headings: List of all status types.
 * - display: (optional) May have a value of 'status' or 'error' when only
 *   displaying messages of that specific type.
 * - attributes: HTML attributes for the element, including:
 *   - class: HTML classes.
 *
 * @see template_preprocess_status_messages()
 *
 * @ingroup themeable
 */
#}
{{ attach_library('bootstrap/toast') }}

<div class=\"toast-container position-fixed top-0 end-0 p3\" aria-live=\"polite\" aria-atomic=\"true\" data-drupal-messages>

  {% for type, messages in message_list %}
    {%
      set classes = [
        'toast',
        'fade',
      ]
    %}
    {%
      set heading = {
        'status': 'Status message'|t,
        'error': 'Error message'|t,
        'warning': 'Warning message'|t,
        'info': 'Informative message'|t,
      }
    %}
    {%
      set color = {
        'status': '#28a745',
        'warning': '#dc3545',
        'error': '#ffc107',
        'info': '#17a2b8',
      }
    %}
    {%
      set role = {
        'status': 'status',
        'warning': 'alert',
        'error': 'alert',
        'info': 'info',
      }
    %}
    {%
      set autohide = {
        'status': 'true',
        'warning': 'false',
        'error': 'true',
        'info': 'false',
      }
    %}
    {% for message in messages %}
      <!-- Then put toasts within -->
      <div {{ attributes|without('role', 'aria-label').addClass(classes).setAttribute('data-drupal-selector', 'messages').setAttribute('role', role[type]).setAttribute('data-bs-autohide', autohide[type]) }} aria-live=\"assertive\" aria-atomic=\"true\">
        <div class=\"toast-header\">
          <svg class=\"bd-placeholder-img rounded mr-2\" width=\"20\" height=\"20\" xmlns=\"http://www.w3.org/2000/svg\" preserveaspectratio=\"xMidYMid slice\" focusable=\"false\" role=\"img\">
            <rect {{ attributes.setAttribute('fill', color[type]) }} width=\"100%\" height=\"100%\"></rect>
          </svg>
          <strong class=\"me-auto\">{{ status_headings[type] }}</strong>
          <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"toast\" aria-label=\"Close\"></button>
        </div>
        <div class=\"toast-body\">
          {{ message }}
        </div>
      </div>
    {% endfor %}
  {% endfor %}
</div>
", "themes/contrib/bootstrap/templates/misc/status-messages--toasts.html.twig", "/var/www/html/jobportal/themes/contrib/bootstrap/templates/misc/status-messages--toasts.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["for" => 32, "set" => 34];
        static $filters = ["escape" => 28, "t" => 41, "without" => 73];
        static $functions = ["attach_library" => 28];

        try {
            $this->sandbox->checkSecurity(
                ['for', 'set'],
                ['escape', 't', 'without'],
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
