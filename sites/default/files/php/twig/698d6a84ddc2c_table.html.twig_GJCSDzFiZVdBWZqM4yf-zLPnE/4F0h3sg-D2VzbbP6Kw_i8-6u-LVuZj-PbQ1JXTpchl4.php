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

/* themes/contrib/bootstrap/templates/dataset/table.html.twig */
class __TwigTemplate_3baad77144818887b2b72e7b9e89b8b9 extends Template
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
        // line 43
        yield "
";
        // line 45
        $context["table_classes"] = ["table", (((($tmp =         // line 47
($context["hover"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("table-hover") : ("")), (((($tmp =  !        // line 48
($context["no_striping"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("table-striped") : ("table-bordered"))];
        // line 51
        yield "<div class=\"table-responsive\">
<table";
        // line 52
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["table_classes"] ?? null)], "method", false, false, true, 52), "html", null, true);
        yield ">
  ";
        // line 53
        if ((($tmp = ($context["caption"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 54
            yield "    <caption>";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["caption"] ?? null), "html", null, true);
            yield "</caption>
  ";
        }
        // line 56
        yield "
  ";
        // line 57
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["colgroups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["colgroup"]) {
            // line 58
            yield "    ";
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["colgroup"], "cols", [], "any", false, false, true, 58)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 59
                yield "      <colgroup";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["colgroup"], "attributes", [], "any", false, false, true, 59), "html", null, true);
                yield ">
        ";
                // line 60
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["colgroup"], "cols", [], "any", false, false, true, 60));
                foreach ($context['_seq'] as $context["_key"] => $context["col"]) {
                    // line 61
                    yield "          <col";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["col"], "attributes", [], "any", false, false, true, 61), "html", null, true);
                    yield " />
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['col'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 63
                yield "      </colgroup>
    ";
            } else {
                // line 65
                yield "      <colgroup";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["colgroup"], "attributes", [], "any", false, false, true, 65), "html", null, true);
                yield " />
    ";
            }
            // line 67
            yield "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['colgroup'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 68
        yield "
  ";
        // line 69
        if ((($tmp = ($context["header"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 70
            yield "    <thead class='";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["thead_class"] ?? null), "html", null, true);
            yield "'>
      <tr>
        ";
            // line 72
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["header"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                // line 73
                yield "          ";
                // line 74
                $context["cell_classes"] = [(((($tmp = CoreExtension::getAttribute($this->env, $this->source,                 // line 75
$context["cell"], "active_table_sort", [], "any", false, false, true, 75)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""))];
                // line 78
                yield "          <";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "tag", [], "any", false, false, true, 78), "html", null, true);
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "attributes", [], "any", false, false, true, 78), "addClass", [($context["cell_classes"] ?? null)], "method", false, false, true, 78), "html", null, true);
                yield ">";
                // line 79
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "content", [], "any", false, false, true, 79), "html", null, true);
                // line 80
                yield "</";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "tag", [], "any", false, false, true, 80), "html", null, true);
                yield ">
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['cell'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 82
            yield "      </tr>
    </thead>
  ";
        }
        // line 85
        yield "
  ";
        // line 86
        if ((($tmp = ($context["rows"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 87
            yield "    <tbody>
      ";
            // line 88
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["rows"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 89
                yield "        ";
                // line 90
                $context["row_classes"] = [(((($tmp =  !                // line 91
($context["no_striping"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (Twig\Extension\CoreExtension::cycle(["odd", "even"], CoreExtension::getAttribute($this->env, $this->source, $context["loop"], "index0", [], "any", false, false, true, 91))) : (""))];
                // line 94
                yield "        <tr";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["row"], "attributes", [], "any", false, false, true, 94), "addClass", [($context["row_classes"] ?? null)], "method", false, false, true, 94), "html", null, true);
                yield ">
          ";
                // line 95
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "cells", [], "any", false, false, true, 95));
                foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                    // line 96
                    yield "            <";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "tag", [], "any", false, false, true, 96), "html", null, true);
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "attributes", [], "any", false, false, true, 96), "html", null, true);
                    yield ">";
                    // line 97
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "content", [], "any", false, false, true, 97), "html", null, true);
                    // line 98
                    yield "</";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "tag", [], "any", false, false, true, 98), "html", null, true);
                    yield ">
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['cell'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 100
                yield "        </tr>
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
            unset($context['_seq'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 102
            yield "    </tbody>
  ";
        } elseif ((($tmp =         // line 103
($context["empty"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 104
            yield "    <tbody>
      <tr class=\"odd\">
        <td colspan=\"";
            // line 106
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["header_columns"] ?? null), "html", null, true);
            yield "\" class=\"empty message\">";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["empty"] ?? null), "html", null, true);
            yield "</td>
      </tr>
    </tbody>
  ";
        }
        // line 110
        yield "  ";
        if ((($tmp = ($context["footer"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 111
            yield "    <tfoot>
      ";
            // line 112
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(($context["footer"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 113
                yield "        <tr";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["row"], "attributes", [], "any", false, false, true, 113), "html", null, true);
                yield ">
          ";
                // line 114
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, $context["row"], "cells", [], "any", false, false, true, 114));
                foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                    // line 115
                    yield "            <";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "tag", [], "any", false, false, true, 115), "html", null, true);
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "attributes", [], "any", false, false, true, 115), "html", null, true);
                    yield ">";
                    // line 116
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "content", [], "any", false, false, true, 116), "html", null, true);
                    // line 117
                    yield "</";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["cell"], "tag", [], "any", false, false, true, 117), "html", null, true);
                    yield ">
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['cell'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 119
                yield "        </tr>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['row'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 121
            yield "    </tfoot>
  ";
        }
        // line 123
        yield "</table>
</div>";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["hover", "no_striping", "attributes", "caption", "colgroups", "header", "thead_class", "rows", "loop", "empty", "header_columns", "footer"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap/templates/dataset/table.html.twig";
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
        return array (  285 => 123,  281 => 121,  274 => 119,  265 => 117,  263 => 116,  258 => 115,  254 => 114,  249 => 113,  245 => 112,  242 => 111,  239 => 110,  230 => 106,  226 => 104,  224 => 103,  221 => 102,  206 => 100,  197 => 98,  195 => 97,  190 => 96,  186 => 95,  181 => 94,  179 => 91,  178 => 90,  176 => 89,  159 => 88,  156 => 87,  154 => 86,  151 => 85,  146 => 82,  137 => 80,  135 => 79,  130 => 78,  128 => 75,  127 => 74,  125 => 73,  121 => 72,  115 => 70,  113 => 69,  110 => 68,  104 => 67,  98 => 65,  94 => 63,  85 => 61,  81 => 60,  76 => 59,  73 => 58,  69 => 57,  66 => 56,  60 => 54,  58 => 53,  54 => 52,  51 => 51,  49 => 48,  48 => 47,  47 => 45,  44 => 43,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{#
/**
 * @file
 * Theme override to display a table.
 *
 * Available variables:
 * - attributes: HTML attributes to apply to the <table> tag.
 * - caption: A localized string for the <caption> tag.
 * - colgroups: Column groups. Each group contains the following properties:
 *   - attributes: HTML attributes to apply to the <col> tag.
 *     Note: Drupal currently supports only one table header row, see
 *     https://www.drupal.org/node/893530 and
 *     http://api.drupal.org/api/drupal/includes!theme.inc/function/theme_table/7#comment-5109.
 * - header: Table header cells. Each cell contains the following properties:
 *   - tag: The HTML tag name to use; either TH or TD.
 *   - attributes: HTML attributes to apply to the tag.
 *   - content: A localized string for the title of the column.
 *   - field: Field name (required for column sorting).
 *   - sort: Default sort order for this column (\"asc\" or \"desc\").
 * - sticky: A flag indicating whether to use a \"sticky\" table header.
 * - rows: Table rows. Each row contains the following properties:
 *   - attributes: HTML attributes to apply to the <tr> tag.
 *   - data: Table cells.
 *   - no_striping: A flag indicating that the row should receive no
 *     'even / odd' styling. Defaults to FALSE.
 *   - cells: Table cells of the row. Each cell contains the following keys:
 *     - tag: The HTML tag name to use; either TH or TD.
 *     - attributes: Any HTML attributes, such as \"colspan\", to apply to the
 *       table cell.
 *     - content: The string to display in the table cell.
 *     - active_table_sort: A boolean indicating whether the cell is the active
         table sort.
 * - footer: Table footer rows, in the same format as the rows variable.
 * - empty: The message to display in an extra row if table does not have
 *   any rows.
 * - no_striping: A boolean indicating that the row should receive no striping.
 * - header_columns: The number of columns in the header.
 * - thead_class: Class for the table header
 *
 * @see template_preprocess_table()
 */
#}

{%
  set table_classes = [
    'table',
    hover ? 'table-hover',
    not no_striping ? 'table-striped' : 'table-bordered',
  ]
%}
<div class=\"table-responsive\">
<table{{ attributes.addClass(table_classes) }}>
  {% if caption %}
    <caption>{{ caption }}</caption>
  {% endif %}

  {% for colgroup in colgroups %}
    {% if colgroup.cols %}
      <colgroup{{ colgroup.attributes }}>
        {% for col in colgroup.cols %}
          <col{{ col.attributes }} />
        {% endfor %}
      </colgroup>
    {% else %}
      <colgroup{{ colgroup.attributes }} />
    {% endif %}
  {% endfor %}

  {% if header %}
    <thead class='{{ thead_class }}'>
      <tr>
        {% for cell in header %}
          {%
            set cell_classes = [
              cell.active_table_sort ? 'active',
            ]
          %}
          <{{ cell.tag }}{{ cell.attributes.addClass(cell_classes) }}>
            {{- cell.content -}}
          </{{ cell.tag }}>
        {% endfor %}
      </tr>
    </thead>
  {% endif %}

  {% if rows %}
    <tbody>
      {% for row in rows %}
        {%
          set row_classes = [
            not no_striping ? cycle(['odd', 'even'], loop.index0),
          ]
        %}
        <tr{{ row.attributes.addClass(row_classes) }}>
          {% for cell in row.cells %}
            <{{ cell.tag }}{{ cell.attributes }}>
              {{- cell.content -}}
            </{{ cell.tag }}>
          {% endfor %}
        </tr>
      {% endfor %}
    </tbody>
  {% elseif empty %}
    <tbody>
      <tr class=\"odd\">
        <td colspan=\"{{ header_columns }}\" class=\"empty message\">{{ empty }}</td>
      </tr>
    </tbody>
  {% endif %}
  {% if footer %}
    <tfoot>
      {% for row in footer %}
        <tr{{ row.attributes }}>
          {% for cell in row.cells %}
            <{{ cell.tag }}{{ cell.attributes }}>
              {{- cell.content -}}
            </{{ cell.tag }}>
          {% endfor %}
        </tr>
      {% endfor %}
    </tfoot>
  {% endif %}
</table>
</div>", "themes/contrib/bootstrap/templates/dataset/table.html.twig", "/var/www/html/jobportal/themes/contrib/bootstrap/templates/dataset/table.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 45, "if" => 53, "for" => 57];
        static $filters = ["escape" => 52];
        static $functions = ["cycle" => 91];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'for'],
                ['escape'],
                ['cycle'],
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
