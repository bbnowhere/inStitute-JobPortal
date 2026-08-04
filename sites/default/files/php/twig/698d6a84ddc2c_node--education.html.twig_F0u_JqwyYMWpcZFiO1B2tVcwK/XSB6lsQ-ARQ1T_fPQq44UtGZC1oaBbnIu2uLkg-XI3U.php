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

/* themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--education.html.twig */
class __TwigTemplate_b521501122874b30d0c04e2e53bc4d7a extends Template
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
    Education
  </div>
  <div class=\"card-body\">
    ";
        // line 6
        $context["education_items"] = [["Qualification" => CoreExtension::getAttribute($this->env, $this->source,         // line 8
($context["content"] ?? null), "field_10th_qualification_name", [], "any", false, false, true, 8), "Specialization" => CoreExtension::getAttribute($this->env, $this->source,         // line 9
($context["content"] ?? null), "field_10th_specialization", [], "any", false, false, true, 9), "University" => CoreExtension::getAttribute($this->env, $this->source,         // line 10
($context["content"] ?? null), "field_10th_university", [], "any", false, false, true, 10), "Country" => CoreExtension::getAttribute($this->env, $this->source,         // line 11
($context["content"] ?? null), "field_10th_country", [], "any", false, false, true, 11), "CGPA/GPA" => CoreExtension::getAttribute($this->env, $this->source,         // line 12
($context["content"] ?? null), "field_10th_gpa", [], "any", false, false, true, 12), "Marks (%)" => CoreExtension::getAttribute($this->env, $this->source,         // line 13
($context["content"] ?? null), "field_10th_marks_percentage", [], "any", false, false, true, 13), "Month/Year of Passing" => CoreExtension::getAttribute($this->env, $this->source,         // line 14
($context["content"] ?? null), "field_10th_year_of_passing", [], "any", false, false, true, 14), "Certificate" => CoreExtension::getAttribute($this->env, $this->source,         // line 15
($context["content"] ?? null), "field_10th_certificate", [], "any", false, false, true, 15)], ["Qualification" => CoreExtension::getAttribute($this->env, $this->source,         // line 18
($context["content"] ?? null), "field_12th_qualification_name", [], "any", false, false, true, 18), "Specialization" => CoreExtension::getAttribute($this->env, $this->source,         // line 19
($context["content"] ?? null), "field_12th_specialization", [], "any", false, false, true, 19), "University" => CoreExtension::getAttribute($this->env, $this->source,         // line 20
($context["content"] ?? null), "field_12th_university", [], "any", false, false, true, 20), "Country" => CoreExtension::getAttribute($this->env, $this->source,         // line 21
($context["content"] ?? null), "field_12th_country", [], "any", false, false, true, 21), "CGPA/GPA" => CoreExtension::getAttribute($this->env, $this->source,         // line 22
($context["content"] ?? null), "field_12th_gpa", [], "any", false, false, true, 22), "Marks (%)" => CoreExtension::getAttribute($this->env, $this->source,         // line 23
($context["content"] ?? null), "field_12th_marks_percentage", [], "any", false, false, true, 23), "Month/Year of Passing" => CoreExtension::getAttribute($this->env, $this->source,         // line 24
($context["content"] ?? null), "field_12th_year_of_passing", [], "any", false, false, true, 24), "Certificate" => CoreExtension::getAttribute($this->env, $this->source,         // line 25
($context["content"] ?? null), "field_12th_certificate", [], "any", false, false, true, 25)], ["Qualification" => CoreExtension::getAttribute($this->env, $this->source,         // line 28
($context["content"] ?? null), "field_grad_qual_name", [], "any", false, false, true, 28), "Specialization" => CoreExtension::getAttribute($this->env, $this->source,         // line 29
($context["content"] ?? null), "field_grad_spec", [], "any", false, false, true, 29), "University" => CoreExtension::getAttribute($this->env, $this->source,         // line 30
($context["content"] ?? null), "field_grad_univ", [], "any", false, false, true, 30), "Country" => CoreExtension::getAttribute($this->env, $this->source,         // line 31
($context["content"] ?? null), "field_grad_country", [], "any", false, false, true, 31), "CGPA/GPA" => CoreExtension::getAttribute($this->env, $this->source,         // line 32
($context["content"] ?? null), "field_grad_gpa", [], "any", false, false, true, 32), "Marks (%)" => CoreExtension::getAttribute($this->env, $this->source,         // line 33
($context["content"] ?? null), "field_grad_marks", [], "any", false, false, true, 33), "Month/Year of Passing" => CoreExtension::getAttribute($this->env, $this->source,         // line 34
($context["content"] ?? null), "field_grad_year", [], "any", false, false, true, 34), "Certificate" => CoreExtension::getAttribute($this->env, $this->source,         // line 35
($context["content"] ?? null), "field_grad_cert", [], "any", false, false, true, 35)], ["Qualification" => CoreExtension::getAttribute($this->env, $this->source,         // line 38
($context["content"] ?? null), "field_pg_qual_name", [], "any", false, false, true, 38), "Specialization" => CoreExtension::getAttribute($this->env, $this->source,         // line 39
($context["content"] ?? null), "field_pg_spec", [], "any", false, false, true, 39), "University" => CoreExtension::getAttribute($this->env, $this->source,         // line 40
($context["content"] ?? null), "field_pg_univ", [], "any", false, false, true, 40), "Country" => CoreExtension::getAttribute($this->env, $this->source,         // line 41
($context["content"] ?? null), "field_pg_country", [], "any", false, false, true, 41), "CGPA/GPA" => CoreExtension::getAttribute($this->env, $this->source,         // line 42
($context["content"] ?? null), "field_pg_gpa", [], "any", false, false, true, 42), "Marks (%)" => CoreExtension::getAttribute($this->env, $this->source,         // line 43
($context["content"] ?? null), "field_pg_marks", [], "any", false, false, true, 43), "Month/Year of Passing" => CoreExtension::getAttribute($this->env, $this->source,         // line 44
($context["content"] ?? null), "field_pg_year", [], "any", false, false, true, 44), "Certificate" => CoreExtension::getAttribute($this->env, $this->source,         // line 45
($context["content"] ?? null), "field_pg_cert", [], "any", false, false, true, 45)], ["Qualification" => CoreExtension::getAttribute($this->env, $this->source,         // line 48
($context["content"] ?? null), "field_phd_qual_name", [], "any", false, false, true, 48), "Specialization" => CoreExtension::getAttribute($this->env, $this->source,         // line 49
($context["content"] ?? null), "field_phd_spec", [], "any", false, false, true, 49), "University" => CoreExtension::getAttribute($this->env, $this->source,         // line 50
($context["content"] ?? null), "field_phd_univ", [], "any", false, false, true, 50), "Country" => CoreExtension::getAttribute($this->env, $this->source,         // line 51
($context["content"] ?? null), "field_phd_country", [], "any", false, false, true, 51), "CGPA/GPA" => CoreExtension::getAttribute($this->env, $this->source,         // line 52
($context["content"] ?? null), "field_phd_gpa", [], "any", false, false, true, 52), "Marks (%)" => CoreExtension::getAttribute($this->env, $this->source,         // line 53
($context["content"] ?? null), "field_phd_marks", [], "any", false, false, true, 53), "Month/Year of Passing" => CoreExtension::getAttribute($this->env, $this->source,         // line 54
($context["content"] ?? null), "field_phd_year", [], "any", false, false, true, 54), "Certificate" => CoreExtension::getAttribute($this->env, $this->source,         // line 55
($context["content"] ?? null), "field_phd_cert", [], "any", false, false, true, 55)], ["Qualification" => CoreExtension::getAttribute($this->env, $this->source,         // line 58
($context["content"] ?? null), "field_other_qualification_name", [], "any", false, false, true, 58), "Specialization" => CoreExtension::getAttribute($this->env, $this->source,         // line 59
($context["content"] ?? null), "field_other_specialization", [], "any", false, false, true, 59), "University" => CoreExtension::getAttribute($this->env, $this->source,         // line 60
($context["content"] ?? null), "field_other_university", [], "any", false, false, true, 60), "Country" => CoreExtension::getAttribute($this->env, $this->source,         // line 61
($context["content"] ?? null), "field_other_country", [], "any", false, false, true, 61), "CGPA/GPA" => CoreExtension::getAttribute($this->env, $this->source,         // line 62
($context["content"] ?? null), "field_other_gpa", [], "any", false, false, true, 62), "Marks (%)" => CoreExtension::getAttribute($this->env, $this->source,         // line 63
($context["content"] ?? null), "field_other_marks_percentage", [], "any", false, false, true, 63), "Month/Year of Passing" => CoreExtension::getAttribute($this->env, $this->source,         // line 64
($context["content"] ?? null), "field_other_year_of_passing", [], "any", false, false, true, 64), "Certificate" => CoreExtension::getAttribute($this->env, $this->source,         // line 65
($context["content"] ?? null), "field_other_certificate", [], "any", false, false, true, 65)]];
        // line 68
        yield "
    ";
        // line 69
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["education_items"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["edu"]) {
            // line 70
            yield "      <div class=\"card mb-3\">
        <div class=\"card-body p-0\">
          ";
            // line 72
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["edu"]);
            foreach ($context['_seq'] as $context["label"] => $context["value"]) {
                // line 73
                yield "            <div class=\"d-flex border-bottom py-2 px-3\">
              <div class=\"font-weight-bold col-md-3\">";
                // line 74
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $context["label"], "html", null, true);
                yield "</div>
              <div class=\"col-md-9\">";
                // line 75
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $context["value"], "html", null, true);
                yield "</div>
            </div>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['label'], $context['value'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 78
            yield "        </div>
      </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['edu'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 81
        yield "  </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["content"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--education.html.twig";
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
        return array (  140 => 81,  132 => 78,  123 => 75,  119 => 74,  116 => 73,  112 => 72,  108 => 70,  104 => 69,  101 => 68,  99 => 65,  98 => 64,  97 => 63,  96 => 62,  95 => 61,  94 => 60,  93 => 59,  92 => 58,  91 => 55,  90 => 54,  89 => 53,  88 => 52,  87 => 51,  86 => 50,  85 => 49,  84 => 48,  83 => 45,  82 => 44,  81 => 43,  80 => 42,  79 => 41,  78 => 40,  77 => 39,  76 => 38,  75 => 35,  74 => 34,  73 => 33,  72 => 32,  71 => 31,  70 => 30,  69 => 29,  68 => 28,  67 => 25,  66 => 24,  65 => 23,  64 => 22,  63 => 21,  62 => 20,  61 => 19,  60 => 18,  59 => 15,  58 => 14,  57 => 13,  56 => 12,  55 => 11,  54 => 10,  53 => 9,  52 => 8,  51 => 6,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"card shadow mb-4\">
  <div class=\"card-header bg-primary text-white\">
    Education
  </div>
  <div class=\"card-body\">
    {% set education_items = [
      {
        'Qualification': content.field_10th_qualification_name,
        'Specialization': content.field_10th_specialization,
        'University': content.field_10th_university,
        'Country': content.field_10th_country,
        'CGPA/GPA': content.field_10th_gpa,
        'Marks (%)': content.field_10th_marks_percentage,
        'Month/Year of Passing': content.field_10th_year_of_passing,
        'Certificate': content.field_10th_certificate
      },
      {
        'Qualification': content.field_12th_qualification_name,
        'Specialization': content.field_12th_specialization,
        'University': content.field_12th_university,
        'Country': content.field_12th_country,
        'CGPA/GPA': content.field_12th_gpa,
        'Marks (%)': content.field_12th_marks_percentage,
        'Month/Year of Passing': content.field_12th_year_of_passing,
        'Certificate': content.field_12th_certificate
      },
      {
        'Qualification': content.field_grad_qual_name,
        'Specialization': content.field_grad_spec,
        'University': content.field_grad_univ,
        'Country': content.field_grad_country,
        'CGPA/GPA': content.field_grad_gpa,
        'Marks (%)': content.field_grad_marks,
        'Month/Year of Passing': content.field_grad_year,
        'Certificate': content.field_grad_cert
      },
      {
        'Qualification': content.field_pg_qual_name,
        'Specialization': content.field_pg_spec,
        'University': content.field_pg_univ,
        'Country': content.field_pg_country,
        'CGPA/GPA': content.field_pg_gpa,
        'Marks (%)': content.field_pg_marks,
        'Month/Year of Passing': content.field_pg_year,
        'Certificate': content.field_pg_cert
      },
      {
        'Qualification': content.field_phd_qual_name,
        'Specialization': content.field_phd_spec,
        'University': content.field_phd_univ,
        'Country': content.field_phd_country,
        'CGPA/GPA': content.field_phd_gpa,
        'Marks (%)': content.field_phd_marks,
        'Month/Year of Passing': content.field_phd_year,
        'Certificate': content.field_phd_cert
      },
      {
        'Qualification': content.field_other_qualification_name,
        'Specialization': content.field_other_specialization,
        'University': content.field_other_university,
        'Country': content.field_other_country,
        'CGPA/GPA': content.field_other_gpa,
        'Marks (%)': content.field_other_marks_percentage,
        'Month/Year of Passing': content.field_other_year_of_passing,
        'Certificate': content.field_other_certificate
      }
    ] %}

    {% for edu in education_items %}
      <div class=\"card mb-3\">
        <div class=\"card-body p-0\">
          {% for label, value in edu %}
            <div class=\"d-flex border-bottom py-2 px-3\">
              <div class=\"font-weight-bold col-md-3\">{{ label }}</div>
              <div class=\"col-md-9\">{{ value }}</div>
            </div>
          {% endfor %}
        </div>
      </div>
    {% endfor %}
  </div>
</div>
", "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--education.html.twig", "/var/www/html/jobportal/themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--education.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 6, "for" => 69];
        static $filters = ["escape" => 74];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'for'],
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
