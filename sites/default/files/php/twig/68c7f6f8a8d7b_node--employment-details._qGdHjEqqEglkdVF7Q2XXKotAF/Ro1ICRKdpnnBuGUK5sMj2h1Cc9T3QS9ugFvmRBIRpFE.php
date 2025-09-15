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

/* themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--employment-details.html.twig */
class __TwigTemplate_bd9ea45f9499ab831bed31767753c79a extends Template
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
        yield "<div class=\"card shadow mb-4\">
  <div class=\"card-header bg-primary text-white\">
    Employment Details
  </div>
  <div class=\"card-body\">
    <div class=\"table table-bordered table-striped\">
      ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_employment_details", [], "any", false, false, true, 7));
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
            // line 8
            yield "        ";
            $context["paragraph"] = CoreExtension::getAttribute($this->env, $this->source, $context["item"], "entity", [], "any", false, false, true, 8);
            // line 9
            yield "        <div class=\"d-flex flex-wrap border bg-white mb-3\">
          <div class=\"p-2 border-end col-md-3 font-weight-bold bg-light\">S.No</div>
          <div class=\"p-2 col-md-9\">";
            // line 11
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, true, 11), "html", null, true);
            yield "</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Designation</div>
          <div class=\"p-2 border-top col-md-9\">";
            // line 14
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paragraph"] ?? null), "field_designation", [], "any", false, false, true, 14), "value", [], "any", false, false, true, 14), "html", null, true);
            yield "</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Employer</div>
          <div class=\"p-2 border-top col-md-9\">";
            // line 17
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paragraph"] ?? null), "field_employer", [], "any", false, false, true, 17), "value", [], "any", false, false, true, 17), "html", null, true);
            yield "</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">From</div>
          <div class=\"p-2 border-top col-md-9\">";
            // line 20
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paragraph"] ?? null), "field_from_date", [], "any", false, false, true, 20), "value", [], "any", false, false, true, 20), "html", null, true);
            yield "</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">To</div>
          <div class=\"p-2 border-top col-md-9\">";
            // line 23
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paragraph"] ?? null), "field_to_date", [], "any", false, false, true, 23), "value", [], "any", false, false, true, 23), "html", null, true);
            yield "</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Employment Type</div>
          <div class=\"p-2 border-top col-md-9\">";
            // line 26
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paragraph"] ?? null), "field_employment_type", [], "any", false, false, true, 26), "value", [], "any", false, false, true, 26), "html", null, true);
            yield "</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Other Employment Type</div>
          <div class=\"p-2 border-top col-md-9\">";
            // line 29
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paragraph"] ?? null), "field_other_employment_type", [], "any", false, false, true, 29), "value", [], "any", false, false, true, 29), "html", null, true);
            yield "</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Type of Work</div>
          <div class=\"p-2 border-top col-md-9\">";
            // line 32
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paragraph"] ?? null), "field_type_of_work", [], "any", false, false, true, 32), "value", [], "any", false, false, true, 32), "html", null, true);
            yield "</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Other Type of Work</div>
          <div class=\"p-2 border-top col-md-9\">";
            // line 35
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paragraph"] ?? null), "field_other_type_of_work", [], "any", false, false, true, 35), "value", [], "any", false, false, true, 35), "html", null, true);
            yield "</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Pay Band</div>
          <div class=\"p-2 border-top col-md-9\">";
            // line 38
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paragraph"] ?? null), "field_pay_band", [], "any", false, false, true, 38), "value", [], "any", false, false, true, 38), "html", null, true);
            yield "</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Nature of Job</div>
          <div class=\"p-2 border-top col-md-9\">";
            // line 41
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paragraph"] ?? null), "field_nature_of_job", [], "any", false, false, true, 41), "value", [], "any", false, false, true, 41), "html", null, true);
            yield "</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Experience</div>
          <div class=\"p-2 border-top col-md-9\">";
            // line 44
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["paragraph"] ?? null), "field_experience_calculated", [], "any", false, false, true, 44), "value", [], "any", false, false, true, 44), "html", null, true);
            yield "</div>
        </div>
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
        // line 47
        yield "    </div>
  </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["node", "loop"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--employment-details.html.twig";
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
        return array (  159 => 47,  142 => 44,  136 => 41,  130 => 38,  124 => 35,  118 => 32,  112 => 29,  106 => 26,  100 => 23,  94 => 20,  88 => 17,  82 => 14,  76 => 11,  72 => 9,  69 => 8,  52 => 7,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"card shadow mb-4\">
  <div class=\"card-header bg-primary text-white\">
    Employment Details
  </div>
  <div class=\"card-body\">
    <div class=\"table table-bordered table-striped\">
      {% for item in node.field_employment_details %}
        {% set paragraph = item.entity %}
        <div class=\"d-flex flex-wrap border bg-white mb-3\">
          <div class=\"p-2 border-end col-md-3 font-weight-bold bg-light\">S.No</div>
          <div class=\"p-2 col-md-9\">{{ loop.index }}</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Designation</div>
          <div class=\"p-2 border-top col-md-9\">{{ paragraph.field_designation.value }}</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Employer</div>
          <div class=\"p-2 border-top col-md-9\">{{ paragraph.field_employer.value }}</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">From</div>
          <div class=\"p-2 border-top col-md-9\">{{ paragraph.field_from_date.value }}</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">To</div>
          <div class=\"p-2 border-top col-md-9\">{{ paragraph.field_to_date.value }}</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Employment Type</div>
          <div class=\"p-2 border-top col-md-9\">{{ paragraph.field_employment_type.value }}</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Other Employment Type</div>
          <div class=\"p-2 border-top col-md-9\">{{ paragraph.field_other_employment_type.value }}</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Type of Work</div>
          <div class=\"p-2 border-top col-md-9\">{{ paragraph.field_type_of_work.value }}</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Other Type of Work</div>
          <div class=\"p-2 border-top col-md-9\">{{ paragraph.field_other_type_of_work.value }}</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Pay Band</div>
          <div class=\"p-2 border-top col-md-9\">{{ paragraph.field_pay_band.value }}</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Nature of Job</div>
          <div class=\"p-2 border-top col-md-9\">{{ paragraph.field_nature_of_job.value }}</div>

          <div class=\"p-2 border-top border-end col-md-3 font-weight-bold bg-light\">Experience</div>
          <div class=\"p-2 border-top col-md-9\">{{ paragraph.field_experience_calculated.value }}</div>
        </div>
      {% endfor %}
    </div>
  </div>
</div>
", "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--employment-details.html.twig", "/var/www/html/jobportal/themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--employment-details.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["for" => 7, "set" => 8];
        static $filters = ["escape" => 11];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['for', 'set'],
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
