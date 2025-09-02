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

/* themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/job-application-dashboard.html.twig */
class __TwigTemplate_5f457f20a4213d7ce56dab63aa9aeef5 extends Template
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
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("bootstrap_sass/application"), "html", null, true);
        yield "

";
        // line 4
        $context["safe_sections"] = [];
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(((array_key_exists("sections", $context)) ? (Twig\Extension\CoreExtension::default(($context["sections"] ?? null), [])) : ([])));
        foreach ($context['_seq'] as $context["key"] => $context["s"]) {
            // line 6
            yield "  ";
            if (((is_iterable($context["s"]) &&  !($context["s"] === true)) &&  !($context["s"] === false))) {
                // line 7
                yield "    ";
                $context["safe_sections"] = Twig\Extension\CoreExtension::merge(($context["safe_sections"] ?? null), [$context["s"]]);
                // line 8
                yield "  ";
            } elseif ((((( !is_iterable($context["s"]) &&  !($context["s"] === true)) &&  !($context["s"] === false)) &&  !(null === $context["s"])) && ($context["s"] != ""))) {
                // line 9
                yield "    ";
                // line 10
                yield "    ";
                $context["safe_sections"] = Twig\Extension\CoreExtension::merge(($context["safe_sections"] ?? null), [["title" => $context["s"], "status" => "incomplete"]]);
                // line 11
                yield "  ";
            } elseif (($context["s"] === true)) {
                // line 12
                yield "    ";
                $context["safe_sections"] = Twig\Extension\CoreExtension::merge(($context["safe_sections"] ?? null), [["title" => $context["key"], "status" => "complete"]]);
                // line 13
                yield "  ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['s'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        yield "
<div class=\"application-dashboard container-fluid my-4\">
  <div class=\"row g-4\">
    <aside class=\"col-lg-4 col-xl-3\">
      ";
        // line 19
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(Twig\Extension\CoreExtension::include($this->env, $context, "application-sidebar-menu.html.twig", ["items" => ($context["safe_sections"] ?? null)]));
        yield "
    </aside>

    <main class=\"col-lg-8 col-xl-9\">
      <div class=\"card shadow-sm\">
        <div class=\"card-body\">
          ";
        // line 25
        $context["completion"] = ((array_key_exists("completion", $context)) ? (Twig\Extension\CoreExtension::default(($context["completion"] ?? null), 0)) : (0));
        // line 26
        yield "          <div class=\"d-flex align-items-start justify-content-between mb-3\">
            <div>
              <h1 class=\"h4 mb-1\">";
        // line 28
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, ($context["job"] ?? null), "label", [], "any", false, false, true, 28)), "html", null, true);
        yield "</h1>
              <small class=\"text-muted\">Job ID: ";
        // line 29
        yield ((CoreExtension::getAttribute($this->env, $this->source, ($context["job"] ?? null), "id", [], "any", true, true, true, 29)) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["job"] ?? null), "id", [], "any", false, false, true, 29), "html", null, true)) : (((CoreExtension::getAttribute($this->env, $this->source, ($context["job"] ?? null), "nid", [], "any", true, true, true, 29)) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["job"] ?? null), "nid", [], "any", false, false, true, 29), "html", null, true)) : (""))));
        yield "</small>
            </div>

            <div class=\"text-end\">
              <div class=\"progress-circle d-inline-block\" title=\"Application completion\">
                <svg viewBox=\"0 0 36 36\" class=\"progress-ring\" role=\"img\" aria-label=\"Completion\">
                  <path class=\"progress-ring-trail\" d=\"M18 2.0845a15.9155 15.9155 0 1 0 0 31.831\"/>
                  <path class=\"progress-ring-bar\" stroke-dasharray=\"";
        // line 36
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["completion"] ?? null), "html", null, true);
        yield ",100\" d=\"M18 2.0845a15.9155 15.9155 0 1 0 0 31.831\"/>
                  <text x=\"18\" y=\"20.5\" class=\"progress-ring-text\">";
        // line 37
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["completion"] ?? null), "html", null, true);
        yield "%</text>
                </svg>
              </div>
            </div>
          </div>

          <div class=\"mb-4\">
            <h5 class=\"mb-2\">Application Progress</h5>
            <div class=\"progress\" style=\"height:12px;\">
              <div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: ";
        // line 46
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["completion"] ?? null), "html", null, true);
        yield "%;\" aria-valuenow=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["completion"] ?? null), "html", null, true);
        yield "\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
            </div>
          </div>

          <div class=\"steps-list row gy-3\">
            ";
        // line 51
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["safe_sections"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            // line 52
            yield "              ";
            $context["status"] = ((CoreExtension::getAttribute($this->env, $this->source, $context["section"], "status", [], "any", true, true, true, 52)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "status", [], "any", false, false, true, 52), "incomplete")) : ("incomplete"));
            // line 53
            yield "              ";
            $context["badge_class"] = (((($context["status"] ?? null) == "complete")) ? ("bg-success") : ((((($context["status"] ?? null) == "in-progress")) ? ("bg-warning text-dark") : ("bg-secondary"))));
            // line 54
            yield "              <div class=\"col-12\">
                <div class=\"d-flex align-items-center p-3 border rounded bg-white\">
                  <div class=\"me-3 step-icon flex-shrink-0\">
                    ";
            // line 57
            if ((($context["status"] ?? null) == "complete")) {
                // line 58
                yield "                      <svg class=\"icon icon-complete\" width=\"36\" height=\"36\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"12\" cy=\"12\" r=\"11\" stroke=\"#28a745\" stroke-width=\"2\"/><path d=\"M7 12.5l2.5 2.5L17 8\" stroke=\"#28a745\" stroke-width=\"2\" fill=\"none\"/></svg>
                    ";
            } elseif ((            // line 59
($context["status"] ?? null) == "in-progress")) {
                // line 60
                yield "                      <svg class=\"icon icon-progress\" width=\"36\" height=\"36\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"12\" cy=\"12\" r=\"11\" stroke=\"#ffc107\" stroke-width=\"2\"/><path d=\"M12 7v6l4 2\" stroke=\"#ffc107\" stroke-width=\"2\" fill=\"none\"/></svg>
                    ";
            } else {
                // line 62
                yield "                      <svg class=\"icon icon-incomplete\" width=\"36\" height=\"36\" viewBox=\"0 0 24 24\" fill=\"none\" aria-hidden=\"true\"><circle cx=\"12\" cy=\"12\" r=\"11\" stroke=\"#6c757d\" stroke-width=\"2\"/></svg>
                    ";
            }
            // line 64
            yield "                  </div>

                  <div class=\"flex-grow-1\">
                    <div class=\"d-flex justify-content-between align-items-start\">
                      <div>
                        <h6 class=\"mb-1\">";
            // line 69
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "title", [], "any", false, false, true, 69)), "html", null, true);
            yield "</h6>
                        ";
            // line 70
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["section"], "description", [], "any", true, true, true, 70) && CoreExtension::getAttribute($this->env, $this->source, $context["section"], "description", [], "any", false, false, true, 70))) {
                // line 71
                yield "                          <div class=\"small text-muted\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["section"], "description", [], "any", false, false, true, 71)), "html", null, true);
                yield "</div>
                        ";
            }
            // line 73
            yield "                      </div>
                      <div class=\"text-end\">
                        <span class=\"badge ";
            // line 75
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["badge_class"] ?? null), "html", null, true);
            yield " rounded-pill px-3 py-2\">
                          ";
            // line 76
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), ($context["status"] ?? null)), "html", null, true);
            yield "
                        </span>
                      </div>
                    </div>

                    <div class=\"mt-2\">
                      ";
            // line 82
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["section"], "link", [], "any", true, true, true, 82) && CoreExtension::getAttribute($this->env, $this->source, $context["section"], "link", [], "any", false, false, true, 82))) {
                // line 83
                yield "                        <a href=\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["section"], "link", [], "any", false, false, true, 83), "html_attr");
                yield "\" class=\"btn btn-outline-primary btn-sm\">Open</a>
                      ";
            }
            // line 85
            yield "                      ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["section"], "edit_link", [], "any", true, true, true, 85) && CoreExtension::getAttribute($this->env, $this->source, $context["section"], "edit_link", [], "any", false, false, true, 85))) {
                // line 86
                yield "                        <a href=\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["section"], "edit_link", [], "any", false, false, true, 86), "html_attr");
                yield "\" class=\"btn btn-primary btn-sm ms-2\">Edit</a>
                      ";
            }
            // line 88
            yield "                    </div>
                  </div>
                </div>
              </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['section'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 93
        yield "          </div>

        </div>
      </div>
    </main>
  </div>
</div>";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["sections", "job"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/job-application-dashboard.html.twig";
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
        return array (  236 => 93,  226 => 88,  220 => 86,  217 => 85,  211 => 83,  209 => 82,  200 => 76,  196 => 75,  192 => 73,  186 => 71,  184 => 70,  180 => 69,  173 => 64,  169 => 62,  165 => 60,  163 => 59,  160 => 58,  158 => 57,  153 => 54,  150 => 53,  147 => 52,  143 => 51,  133 => 46,  121 => 37,  117 => 36,  107 => 29,  103 => 28,  99 => 26,  97 => 25,  88 => 19,  82 => 15,  75 => 13,  72 => 12,  69 => 11,  66 => 10,  64 => 9,  61 => 8,  58 => 7,  55 => 6,  51 => 5,  49 => 4,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/job-application-dashboard.html.twig", "/var/www/html/jobportal/themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/job-application-dashboard.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 4, "for" => 5, "if" => 6];
        static $filters = ["escape" => 1, "default" => 5, "merge" => 7, "striptags" => 28, "capitalize" => 76];
        static $functions = ["attach_library" => 1, "include" => 19];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'for', 'if'],
                ['escape', 'default', 'merge', 'striptags', 'capitalize'],
                ['attach_library', 'include'],
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
