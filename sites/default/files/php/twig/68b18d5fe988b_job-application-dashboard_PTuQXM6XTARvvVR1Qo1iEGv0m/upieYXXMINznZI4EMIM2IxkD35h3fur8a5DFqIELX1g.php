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

/* modules/custom/instemjobportal/templates/job-application-dashboard.html.twig */
class __TwigTemplate_7db51ff8471962127d46dd4f2864307c extends Template
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
        yield "<div class=\"dashboard\">
  <h2>";
        // line 2
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Apply for"));
        yield " ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["job"] ?? null), "label", [], "any", false, false, true, 2), "html", null, true);
        yield "</h2>

  <div class=\"dashboard-layout\">
    <aside class=\"dashboard-sidebar\">
      ";
        // line 7
        yield "      ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["sidebar"] ?? null), "html", null, true);
        yield "
    </aside>

    <main class=\"dashboard-main\">
      <p>";
        // line 11
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Select a section from the sidebar to begin your application."));
        yield "</p>

      ";
        // line 14
        yield "      <ul class=\"dashboard-sections\">
        ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["sections"] ?? null));
        foreach ($context['_seq'] as $context["machine"] => $context["label"]) {
            // line 16
            yield "          <li>
            ";
            // line 17
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $context["label"], "html", null, true);
            yield " - ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar((((($tmp = (($_v0 = ($context["completion"] ?? null)) && is_array($_v0) || $_v0 instanceof ArrayAccess && in_array($_v0::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v0[$context["machine"]] ?? null) : CoreExtension::getAttribute($this->env, $this->source, ($context["completion"] ?? null), $context["machine"], [], "array", false, false, true, 17))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (t("Completed")) : (t("Pending"))));
            yield "
          </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['machine'], $context['label'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        yield "      </ul>
    </main>
  </div>
</div>

";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["job", "sidebar", "sections", "completion"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "modules/custom/instemjobportal/templates/job-application-dashboard.html.twig";
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
        return array (  90 => 20,  79 => 17,  76 => 16,  72 => 15,  69 => 14,  64 => 11,  56 => 7,  47 => 2,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "modules/custom/instemjobportal/templates/job-application-dashboard.html.twig", "/var/www/html/jobportal/modules/custom/instemjobportal/templates/job-application-dashboard.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["for" => 15];
        static $filters = ["t" => 2, "escape" => 2];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['for'],
                ['t', 'escape'],
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
