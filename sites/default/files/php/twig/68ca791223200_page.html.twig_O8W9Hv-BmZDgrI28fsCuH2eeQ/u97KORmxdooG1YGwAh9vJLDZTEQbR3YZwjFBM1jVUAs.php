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

/* themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/page.html.twig */
class __TwigTemplate_c6ef76a86d0f4c0bd275e4846af134d0 extends Template
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
            'head' => [$this, 'block_head'],
            'featured' => [$this, 'block_featured'],
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->extensions[SandboxExtension::class];
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 71
        $context["sidebar_first_exists"] =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim(Twig\Extension\CoreExtension::striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 71)), "<img><video><audio><drupal-render-placeholder>")));
        // line 72
        $context["sidebar_second_exists"] =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim(Twig\Extension\CoreExtension::striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 72)), "<img><video><audio><drupal-render-placeholder>")));
        // line 73
        yield "
<div id=\"page-wrapper\">
  <div id=\"page\">
    ";
        // line 76
        yield from $this->unwrap()->yieldBlock('head', $context, $blocks);
        // line 131
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 131)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 132
            yield "      <div class=\"highlighted\">
        <aside class=\"";
            // line 133
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["container"] ?? null), "html", null, true);
            yield " section clearfix\" role=\"complementary\">
          ";
            // line 134
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 134), "html", null, true);
            yield "
        </aside>
      </div>
    ";
        }
        // line 138
        yield "    ";
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_top", [], "any", false, false, true, 138)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 139
            yield "      ";
            yield from $this->unwrap()->yieldBlock('featured', $context, $blocks);
            // line 146
            yield "    ";
        }
        // line 147
        yield "    <div id=\"main-wrapper\" class=\"layout-main-wrapper clearfix\">
      ";
        // line 148
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 175
        yield "    </div>
    ";
        // line 176
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_first", [], "any", false, false, true, 176) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_second", [], "any", false, false, true, 176)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_third", [], "any", false, false, true, 176))) {
            // line 177
            yield "      <div class=\"featured-bottom\">
        <aside class=\"";
            // line 178
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["container"] ?? null), "html", null, true);
            yield " clearfix\" role=\"complementary\">
          ";
            // line 179
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_first", [], "any", false, false, true, 179), "html", null, true);
            yield "
          ";
            // line 180
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_second", [], "any", false, false, true, 180), "html", null, true);
            yield "
          ";
            // line 181
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_third", [], "any", false, false, true, 181), "html", null, true);
            yield "
        </aside>
      </div>
    ";
        }
        // line 185
        yield "    <footer class=\"bg-dark text-white py-3 mt-5\">
      <div class=\"container text-center\">
        <small>&copy; ";
        // line 187
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " inStem Job Portal. All rights reserved.</small>
        <div>
          <a href=\"/privacy\" class=\"text-white me-3\">Privacy Policy</a>
          <a href=\"/contact\" class=\"text-white\">Contact</a>
        </div>
      </div>
    </footer>
  </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page", "container", "navbar_top_attributes", "container_navbar", "navbar_attributes", "navbar_collapse_btn_data", "navbar_collapse_class", "navbar_offcanvas", "sidebar_collapse", "content_attributes", "sidebar_first_attributes", "sidebar_second_attributes"]);        yield from [];
    }

    // line 76
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_head(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 77
        yield "      ";
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "secondary_menu", [], "any", false, false, true, 77) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header", [], "any", false, false, true, 77)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header_form", [], "any", false, false, true, 77))) {
            // line 78
            yield "        <nav";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["navbar_top_attributes"] ?? null), "html", null, true);
            yield ">
          ";
            // line 79
            if ((($tmp = ($context["container_navbar"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 80
                yield "          <div class=\"container\">
          ";
            }
            // line 82
            yield "            ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "secondary_menu", [], "any", false, false, true, 82), "html", null, true);
            yield "
            ";
            // line 83
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header", [], "any", false, false, true, 83), "html", null, true);
            yield "
            ";
            // line 84
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header_form", [], "any", false, false, true, 84)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 85
                yield "              <div class=\"form-inline navbar-form ms-auto\">
                ";
                // line 86
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "top_header_form", [], "any", false, false, true, 86), "html", null, true);
                yield "
              </div>
            ";
            }
            // line 89
            yield "          ";
            if ((($tmp = ($context["container_navbar"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 90
                yield "          </div>
          ";
            }
            // line 92
            yield "        </nav>
      ";
        }
        // line 94
        yield "      ";
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 94) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 94)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 94))) {
            // line 95
            yield "        <header class=\"bg-light-header py-2\">
          <nav";
            // line 96
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["navbar_attributes"] ?? null), "html", null, true);
            yield ">
            ";
            // line 97
            if ((($tmp = ($context["container_navbar"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 98
                yield "            <div class=\"container\">
            ";
            }
            // line 100
            yield "              ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 100), "html", null, true);
            yield "
              ";
            // line 101
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 101) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 101))) {
                // line 102
                yield "                <button class=\"navbar-toggler collapsed\" type=\"button\" data-bs-toggle=\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["navbar_collapse_btn_data"] ?? null), "html", null, true);
                yield "\" data-bs-target=\"#CollapsingNavbar\" aria-controls=\"CollapsingNavbar\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"><span class=\"navbar-toggler-icon\"></span></button>
                <div class=\"";
                // line 103
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["navbar_collapse_class"] ?? null), "html", null, true);
                yield "\" id=\"CollapsingNavbar\">
                  ";
                // line 104
                if ((($tmp = ($context["navbar_offcanvas"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 105
                    yield "                    <div class=\"offcanvas-header\">
                      <button type=\"button\" class=\"btn-close text-reset\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\"></button>
                    </div>
                    <div class=\"offcanvas-body\">
                  ";
                }
                // line 110
                yield "                  ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 110), "html", null, true);
                yield "
                  ";
                // line 111
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 111)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 112
                    yield "                    <div class=\"form-inline navbar-form justify-content-end\">
                      ";
                    // line 113
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 113), "html", null, true);
                    yield "
                    </div>
                  ";
                }
                // line 116
                yield "                  ";
                if ((($tmp = ($context["navbar_offcanvas"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 117
                    yield "                    </div>
                  ";
                }
                // line 119
                yield "                </div>
              ";
            }
            // line 121
            yield "              ";
            if ((($tmp = ($context["sidebar_collapse"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 122
                yield "                <button class=\"navbar-toggler navbar-toggler-left collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#CollapsingLeft\" aria-controls=\"CollapsingLeft\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"></button>
              ";
            }
            // line 124
            yield "            ";
            if ((($tmp = ($context["container_navbar"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 125
                yield "            </div>
            ";
            }
            // line 127
            yield "          </nav>
        </header>
      ";
        }
        // line 130
        yield "    ";
        yield from [];
    }

    // line 139
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_featured(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 140
        yield "        <div class=\"featured-top\">
          <aside class=\"featured-top__inner section ";
        // line 141
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["container"] ?? null), "html", null, true);
        yield " clearfix\" role=\"complementary\">
            ";
        // line 142
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_top", [], "any", false, false, true, 142), "html", null, true);
        yield "
          </aside>
        </div>
      ";
        yield from [];
    }

    // line 148
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 149
        yield "        <div id=\"main\" class=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["container"] ?? null), "html", null, true);
        yield "\">
          ";
        // line 150
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb", [], "any", false, false, true, 150), "html", null, true);
        yield "
          <div class=\"row row-offcanvas row-offcanvas-left clearfix\">
            <main";
        // line 152
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["content_attributes"] ?? null), "html", null, true);
        yield ">
              <section class=\"section\">
                <a href=\"#main-content\" id=\"main-content\" tabindex=\"-1\"></a>
                ";
        // line 155
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 155), "html", null, true);
        yield "
              </section>
            </main>
            ";
        // line 158
        if ((($tmp = ($context["sidebar_first_exists"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 159
            yield "              <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["sidebar_first_attributes"] ?? null), "html", null, true);
            yield ">
                <aside class=\"section\" role=\"complementary\">
                  ";
            // line 161
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 161), "html", null, true);
            yield "
                </aside>
              </div>
            ";
        }
        // line 165
        yield "            ";
        if ((($tmp = ($context["sidebar_second_exists"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 166
            yield "              <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["sidebar_second_attributes"] ?? null), "html", null, true);
            yield ">
                <aside class=\"section\" role=\"complementary\">
                  ";
            // line 168
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 168), "html", null, true);
            yield "
                </aside>
              </div>
            ";
        }
        // line 172
        yield "          </div>
        </div>
      ";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/page.html.twig";
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
        return array (  363 => 172,  356 => 168,  350 => 166,  347 => 165,  340 => 161,  334 => 159,  332 => 158,  326 => 155,  320 => 152,  315 => 150,  310 => 149,  303 => 148,  294 => 142,  290 => 141,  287 => 140,  280 => 139,  275 => 130,  270 => 127,  266 => 125,  263 => 124,  259 => 122,  256 => 121,  252 => 119,  248 => 117,  245 => 116,  239 => 113,  236 => 112,  234 => 111,  229 => 110,  222 => 105,  220 => 104,  216 => 103,  211 => 102,  209 => 101,  204 => 100,  200 => 98,  198 => 97,  194 => 96,  191 => 95,  188 => 94,  184 => 92,  180 => 90,  177 => 89,  171 => 86,  168 => 85,  166 => 84,  162 => 83,  157 => 82,  153 => 80,  151 => 79,  146 => 78,  143 => 77,  136 => 76,  120 => 187,  116 => 185,  109 => 181,  105 => 180,  101 => 179,  97 => 178,  94 => 177,  92 => 176,  89 => 175,  87 => 148,  84 => 147,  81 => 146,  78 => 139,  75 => 138,  68 => 134,  64 => 133,  61 => 132,  58 => 131,  56 => 76,  51 => 73,  49 => 72,  47 => 71,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{#
/**
 * @file
 * Bootstrap's theme implementation to display a single page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.html.twig template normally located in the
 * core/modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - base_path: The base URL path of the Drupal installation. Will usually be
 *   \"/\" unless you have installed Drupal in a sub-directory.
 * - is_front: A flag indicating if the current page is the front page.
 * - logged_in: A flag indicating if the user is registered and signed in.
 * - is_admin: A flag indicating if the user has permission to access
 *   administration pages.
 *
 * Site identity:
 * - front_page: The URL of the front page. Use this instead of base_path when
 *   linking to the front page. This includes the language domain or prefix.
 * - logo: The url of the logo image, as defined in theme settings.
 * - site_name: The name of the site. This is empty when displaying the site
 *   name has been disabled in the theme settings.
 * - site_slogan: The slogan of the site. This is empty when displaying the site
 *   slogan has been disabled in theme settings.

 * Page content (in order of occurrence in the default page.html.twig):
 * - node: Fully loaded node, if there is an automatically-loaded node
 *   associated with the page and the node ID is the second argument in the
 *   page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - page.top_header: Items for the top header region.
 * - page.top_header_form: Items for the top header form region.
 * - page.header: Items for the header region.
 * - page.header_form: Items for the header form region.
 * - page.highlighted: Items for the highlighted region.
 * - page.primary_menu: Items for the primary menu region.
 * - page.secondary_menu: Items for the secondary menu region.
 * - page.featured_top: Items for the featured top region.
 * - page.content: The main content of the current page.
 * - page.sidebar_first: Items for the first sidebar.
 * - page.sidebar_second: Items for the second sidebar.
 * - page.featured_bottom_first: Items for the first featured bottom region.
 * - page.featured_bottom_second: Items for the second featured bottom region.
 * - page.featured_bottom_third: Items for the third featured bottom region.
 * - page.footer_first: Items for the first footer column.
 * - page.footer_second: Items for the second footer column.
 * - page.footer_third: Items for the third footer column.
 * - page.footer_fourth: Items for the fourth footer column.
 * - page.footer_fifth: Items for the fifth footer column.
 * - page.breadcrumb: Items for the breadcrumb region.
 *
 * Theme variables:
 * - navbar_top_attributes: Items for the header region.
 * - navbar_attributes: Items for the header region.
 * - content_attributes: Items for the header region.
 * - sidebar_first_attributes: Items for the highlighted region.
 * - sidebar_second_attributes: Items for the primary menu region.
 * - sidebar_collapse: If the sidebar_first will collapse.
 *
 * @see template_preprocess_page()
 * @see bootstrap_preprocess_page()
 * @see html.html.twig
 */
#}
{# see https://www.drupal.org/project/drupal/issues/953034#comment-14192130 #}
{% set sidebar_first_exists = page.sidebar_first|render|striptags('<img><video><audio><drupal-render-placeholder>')|trim is not empty %}
{% set sidebar_second_exists = page.sidebar_second|render|striptags('<img><video><audio><drupal-render-placeholder>')|trim is not empty %}

<div id=\"page-wrapper\">
  <div id=\"page\">
    {% block head %}
      {% if page.secondary_menu or page.top_header or page.top_header_form %}
        <nav{{ navbar_top_attributes }}>
          {% if container_navbar %}
          <div class=\"container\">
          {% endif %}
            {{ page.secondary_menu }}
            {{ page.top_header }}
            {% if page.top_header_form %}
              <div class=\"form-inline navbar-form ms-auto\">
                {{ page.top_header_form }}
              </div>
            {% endif %}
          {% if container_navbar %}
          </div>
          {% endif %}
        </nav>
      {% endif %}
      {% if page.header or page.primary_menu or page.header_form %}
        <header class=\"bg-light-header py-2\">
          <nav{{ navbar_attributes }}>
            {% if container_navbar %}
            <div class=\"container\">
            {% endif %}
              {{ page.header }}
              {% if page.primary_menu or page.header_form %}
                <button class=\"navbar-toggler collapsed\" type=\"button\" data-bs-toggle=\"{{ navbar_collapse_btn_data }}\" data-bs-target=\"#CollapsingNavbar\" aria-controls=\"CollapsingNavbar\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"><span class=\"navbar-toggler-icon\"></span></button>
                <div class=\"{{ navbar_collapse_class }}\" id=\"CollapsingNavbar\">
                  {% if navbar_offcanvas %}
                    <div class=\"offcanvas-header\">
                      <button type=\"button\" class=\"btn-close text-reset\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\"></button>
                    </div>
                    <div class=\"offcanvas-body\">
                  {% endif %}
                  {{ page.primary_menu }}
                  {% if page.header_form %}
                    <div class=\"form-inline navbar-form justify-content-end\">
                      {{ page.header_form }}
                    </div>
                  {% endif %}
                  {% if navbar_offcanvas %}
                    </div>
                  {% endif %}
                </div>
              {% endif %}
              {% if sidebar_collapse %}
                <button class=\"navbar-toggler navbar-toggler-left collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#CollapsingLeft\" aria-controls=\"CollapsingLeft\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"></button>
              {% endif %}
            {% if container_navbar %}
            </div>
            {% endif %}
          </nav>
        </header>
      {% endif %}
    {% endblock %}
    {% if page.highlighted %}
      <div class=\"highlighted\">
        <aside class=\"{{ container }} section clearfix\" role=\"complementary\">
          {{ page.highlighted }}
        </aside>
      </div>
    {% endif %}
    {% if page.featured_top %}
      {% block featured %}
        <div class=\"featured-top\">
          <aside class=\"featured-top__inner section {{ container }} clearfix\" role=\"complementary\">
            {{ page.featured_top }}
          </aside>
        </div>
      {% endblock %}
    {% endif %}
    <div id=\"main-wrapper\" class=\"layout-main-wrapper clearfix\">
      {% block content %}
        <div id=\"main\" class=\"{{ container }}\">
          {{ page.breadcrumb }}
          <div class=\"row row-offcanvas row-offcanvas-left clearfix\">
            <main{{ content_attributes }}>
              <section class=\"section\">
                <a href=\"#main-content\" id=\"main-content\" tabindex=\"-1\"></a>
                {{ page.content }}
              </section>
            </main>
            {% if sidebar_first_exists %}
              <div{{ sidebar_first_attributes }}>
                <aside class=\"section\" role=\"complementary\">
                  {{ page.sidebar_first }}
                </aside>
              </div>
            {% endif %}
            {% if sidebar_second_exists %}
              <div{{ sidebar_second_attributes }}>
                <aside class=\"section\" role=\"complementary\">
                  {{ page.sidebar_second }}
                </aside>
              </div>
            {% endif %}
          </div>
        </div>
      {% endblock %}
    </div>
    {% if page.featured_bottom_first or page.featured_bottom_second or page.featured_bottom_third %}
      <div class=\"featured-bottom\">
        <aside class=\"{{ container }} clearfix\" role=\"complementary\">
          {{ page.featured_bottom_first }}
          {{ page.featured_bottom_second }}
          {{ page.featured_bottom_third }}
        </aside>
      </div>
    {% endif %}
    <footer class=\"bg-dark text-white py-3 mt-5\">
      <div class=\"container text-center\">
        <small>&copy; {{ \"now\"|date(\"Y\") }} inStem Job Portal. All rights reserved.</small>
        <div>
          <a href=\"/privacy\" class=\"text-white me-3\">Privacy Policy</a>
          <a href=\"/contact\" class=\"text-white\">Contact</a>
        </div>
      </div>
    </footer>
  </div>
</div>
", "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/page.html.twig", "/var/www/html/jobportal/themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 71, "block" => 76, "if" => 131];
        static $filters = ["trim" => 71, "striptags" => 71, "render" => 71, "escape" => 133, "date" => 187];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'block', 'if'],
                ['trim', 'striptags', 'render', 'escape', 'date'],
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
