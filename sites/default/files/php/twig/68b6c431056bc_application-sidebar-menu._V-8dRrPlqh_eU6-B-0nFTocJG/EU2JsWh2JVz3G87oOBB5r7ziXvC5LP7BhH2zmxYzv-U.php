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

/* application-sidebar-menu.html.twig */
class __TwigTemplate_b85a94c7a86bb71b768e81058b30679f extends Template
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

<nav class=\"application-sidebar sticky-top pt-3\">
  <div class=\"card shadow-sm\">
    <div class=\"card-body\">
      <h5 class=\"card-title mb-3\">Application Sections</h5>
      <ul class=\"list-unstyled mb-0\">
        ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(((array_key_exists("items", $context)) ? (Twig\Extension\CoreExtension::default(($context["items"] ?? null), [])) : ([])));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 9
            yield "          ";
            $context["sstatus"] = ((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "status", [], "any", true, true, true, 9)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "status", [], "any", false, false, true, 9), "incomplete")) : ("incomplete"));
            // line 10
            yield "          ";
            $context["item_class"] = (((($context["sstatus"] ?? null) == "complete")) ? ("completed") : ((((($context["sstatus"] ?? null) == "in-progress")) ? ("in-progress") : ("incomplete"))));
            // line 11
            yield "          <li class=\"sidebar-item d-flex align-items-start mb-3 ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["item_class"] ?? null), "html", null, true);
            yield "\">
            <div class=\"step-number me-3\">
              <span class=\"badge rounded-circle bg-light text-dark border\">";
            // line 13
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, true, 13), "html", null, true);
            yield "</span>
            </div>
            <div class=\"flex-grow-1\">
              <div class=\"d-flex justify-content-between align-items-start\">
                ";
            // line 17
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "link", [], "any", true, true, true, 17) && CoreExtension::getAttribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, true, 17))) {
                // line 18
                yield "                  ";
                // line 19
                yield "                  ";
                if (is_iterable(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, true, 19))) {
                    // line 20
                    yield "                    ";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, true, 20), "html", null, true);
                    yield "
                  ";
                } else {
                    // line 22
                    yield "                    ";
                    $context["l"] = Twig\Extension\CoreExtension::trim(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, true, 22));
                    // line 23
                    yield "                    ";
                    $context["l_lower"] = Twig\Extension\CoreExtension::lower($this->env->getCharset(), ($context["l"] ?? null));
                    // line 24
                    yield "                    ";
                    if ((CoreExtension::inFilter("<a", ($context["l_lower"] ?? null)) || CoreExtension::inFilter("&lt;a", ($context["l_lower"] ?? null)))) {
                        // line 25
                        yield "                      ";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(($context["l"] ?? null));
                        yield "
                    ";
                    } else {
                        // line 27
                        yield "                      <a href=\"";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["l"] ?? null), "html_attr");
                        yield "\" class=\"sidebar-title fw-semibold text-decoration-none\">";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 27)), "html", null, true);
                        yield "</a>
                    ";
                    }
                    // line 29
                    yield "                  ";
                }
                // line 30
                yield "                ";
            } else {
                // line 31
                yield "                  <span class=\"sidebar-title fw-semibold\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 31)), "html", null, true);
                yield "</span>
                ";
            }
            // line 33
            yield "                <span class=\"small text-muted\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), ($context["sstatus"] ?? null)), "html", null, true);
            yield "</span>
              </div>
              ";
            // line 35
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["item"], "summary", [], "any", true, true, true, 35) && CoreExtension::getAttribute($this->env, $this->source, $context["item"], "summary", [], "any", false, false, true, 35))) {
                // line 36
                yield "                <div class=\"small text-muted mt-1\">";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::striptags(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "summary", [], "any", false, false, true, 36)), "html", null, true);
                yield "</div>
              ";
            }
            // line 38
            yield "            </div>
          </li>
        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        yield "      </ul>
    </div>
  </div>

  <div class=\"mt-3 text-center\">
    <a href=\"#\" class=\"btn btn-outline-secondary btn-sm\">Application Help</a>
  </div>
</nav>";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["items", "loop"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "application-sidebar-menu.html.twig";
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
        return array (  168 => 41,  152 => 38,  146 => 36,  144 => 35,  138 => 33,  132 => 31,  129 => 30,  126 => 29,  118 => 27,  112 => 25,  109 => 24,  106 => 23,  103 => 22,  97 => 20,  94 => 19,  92 => 18,  90 => 17,  83 => 13,  77 => 11,  74 => 10,  71 => 9,  54 => 8,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "application-sidebar-menu.html.twig", "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/application-sidebar-menu.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["for" => 8, "set" => 9, "if" => 17];
        static $filters = ["escape" => 1, "default" => 8, "trim" => 22, "lower" => 23, "raw" => 25, "striptags" => 27, "capitalize" => 33];
        static $functions = ["attach_library" => 1];

        try {
            $this->sandbox->checkSecurity(
                ['for', 'set', 'if'],
                ['escape', 'default', 'trim', 'lower', 'raw', 'striptags', 'capitalize'],
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
