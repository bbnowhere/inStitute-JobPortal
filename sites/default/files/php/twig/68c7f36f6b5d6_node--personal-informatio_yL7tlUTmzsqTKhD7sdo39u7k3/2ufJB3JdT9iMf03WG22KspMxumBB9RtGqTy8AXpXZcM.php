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

/* themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--personal-information.html.twig */
class __TwigTemplate_70b0078260f8f36beff189338358de2d extends Template
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
        // line 2
        yield "<div class=\"card shadow mb-4\">
  <div class=\"card-header bg-primary text-white\">
    Personal Information
  </div>
  <div class=\"card-body\">
    <div class=\"row mb-3\">
      <div class=\"col-md-3 text-center\">
        ";
        // line 9
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_photo", [], "any", false, false, true, 9), "html", null, true);
        yield "
        <div class=\"small text-muted\">Photo</div>
      </div>
      <div class=\"col-md-3 text-center\">
        ";
        // line 13
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_signature", [], "any", false, false, true, 13), "html", null, true);
        yield "
        <div class=\"small text-muted\">Signature</div>
      </div>
    </div>
    <table class=\"table table-bordered table-striped\">
      <tbody>
        <tr><th>Full Name</th><td>";
        // line 19
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_full_name", [], "any", false, true, true, 19), "#markup", [], "array", true, true, true, 19) &&  !(null === (($_v0 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_full_name", [], "any", false, false, true, 19)) && is_array($_v0) || $_v0 instanceof ArrayAccess && in_array($_v0::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v0["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_full_name", [], "any", false, false, true, 19), "#markup", [], "array", false, false, true, 19))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v1 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_full_name", [], "any", false, false, true, 19)) && is_array($_v1) || $_v1 instanceof ArrayAccess && in_array($_v1::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v1["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_full_name", [], "any", false, false, true, 19), "#markup", [], "array", false, false, true, 19)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_full_name", [], "any", false, false, true, 19), "html", null, true)));
        yield "</td></tr>
        <tr><th>Date of Birth</th><td>";
        // line 20
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_date_of_birth", [], "any", false, true, true, 20), "#markup", [], "array", true, true, true, 20) &&  !(null === (($_v2 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_date_of_birth", [], "any", false, false, true, 20)) && is_array($_v2) || $_v2 instanceof ArrayAccess && in_array($_v2::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v2["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_date_of_birth", [], "any", false, false, true, 20), "#markup", [], "array", false, false, true, 20))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v3 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_date_of_birth", [], "any", false, false, true, 20)) && is_array($_v3) || $_v3 instanceof ArrayAccess && in_array($_v3::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v3["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_date_of_birth", [], "any", false, false, true, 20), "#markup", [], "array", false, false, true, 20)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_date_of_birth", [], "any", false, false, true, 20), "html", null, true)));
        yield "</td></tr>
        <tr><th>Age</th><td>";
        // line 21
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_age", [], "any", false, true, true, 21), "#markup", [], "array", true, true, true, 21) &&  !(null === (($_v4 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_age", [], "any", false, false, true, 21)) && is_array($_v4) || $_v4 instanceof ArrayAccess && in_array($_v4::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v4["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_age", [], "any", false, false, true, 21), "#markup", [], "array", false, false, true, 21))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v5 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_age", [], "any", false, false, true, 21)) && is_array($_v5) || $_v5 instanceof ArrayAccess && in_array($_v5::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v5["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_age", [], "any", false, false, true, 21), "#markup", [], "array", false, false, true, 21)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_age", [], "any", false, false, true, 21), "html", null, true)));
        yield "</td></tr>
        <tr><th>Father/Mother/Spouse Name</th><td>";
        // line 22
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_father_mother_spouse_name", [], "any", false, true, true, 22), "#markup", [], "array", true, true, true, 22) &&  !(null === (($_v6 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_father_mother_spouse_name", [], "any", false, false, true, 22)) && is_array($_v6) || $_v6 instanceof ArrayAccess && in_array($_v6::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v6["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_father_mother_spouse_name", [], "any", false, false, true, 22), "#markup", [], "array", false, false, true, 22))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v7 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_father_mother_spouse_name", [], "any", false, false, true, 22)) && is_array($_v7) || $_v7 instanceof ArrayAccess && in_array($_v7::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v7["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_father_mother_spouse_name", [], "any", false, false, true, 22), "#markup", [], "array", false, false, true, 22)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_father_mother_spouse_name", [], "any", false, false, true, 22), "html", null, true)));
        yield "</td></tr>
        <tr><th>Email</th><td>";
        // line 23
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_email", [], "any", false, true, true, 23), "#markup", [], "array", true, true, true, 23) &&  !(null === (($_v8 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_email", [], "any", false, false, true, 23)) && is_array($_v8) || $_v8 instanceof ArrayAccess && in_array($_v8::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v8["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_email", [], "any", false, false, true, 23), "#markup", [], "array", false, false, true, 23))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v9 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_email", [], "any", false, false, true, 23)) && is_array($_v9) || $_v9 instanceof ArrayAccess && in_array($_v9::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v9["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_email", [], "any", false, false, true, 23), "#markup", [], "array", false, false, true, 23)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_email", [], "any", false, false, true, 23), "html", null, true)));
        yield "</td></tr>
        <tr><th>Gender</th><td>";
        // line 24
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_gender", [], "any", false, true, true, 24), "#markup", [], "array", true, true, true, 24) &&  !(null === (($_v10 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_gender", [], "any", false, false, true, 24)) && is_array($_v10) || $_v10 instanceof ArrayAccess && in_array($_v10::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v10["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_gender", [], "any", false, false, true, 24), "#markup", [], "array", false, false, true, 24))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v11 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_gender", [], "any", false, false, true, 24)) && is_array($_v11) || $_v11 instanceof ArrayAccess && in_array($_v11::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v11["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_gender", [], "any", false, false, true, 24), "#markup", [], "array", false, false, true, 24)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_gender", [], "any", false, false, true, 24), "html", null, true)));
        yield "</td></tr>
        <tr><th>Category</th><td>";
        // line 25
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_category", [], "any", false, true, true, 25), "#markup", [], "array", true, true, true, 25) &&  !(null === (($_v12 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_category", [], "any", false, false, true, 25)) && is_array($_v12) || $_v12 instanceof ArrayAccess && in_array($_v12::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v12["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_category", [], "any", false, false, true, 25), "#markup", [], "array", false, false, true, 25))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v13 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_category", [], "any", false, false, true, 25)) && is_array($_v13) || $_v13 instanceof ArrayAccess && in_array($_v13::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v13["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_category", [], "any", false, false, true, 25), "#markup", [], "array", false, false, true, 25)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_category", [], "any", false, false, true, 25), "html", null, true)));
        yield "</td></tr>
        <tr><th>PWD Category</th><td>";
        // line 26
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_pwd_category", [], "any", false, true, true, 26), "#markup", [], "array", true, true, true, 26) &&  !(null === (($_v14 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_pwd_category", [], "any", false, false, true, 26)) && is_array($_v14) || $_v14 instanceof ArrayAccess && in_array($_v14::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v14["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_pwd_category", [], "any", false, false, true, 26), "#markup", [], "array", false, false, true, 26))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v15 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_pwd_category", [], "any", false, false, true, 26)) && is_array($_v15) || $_v15 instanceof ArrayAccess && in_array($_v15::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v15["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_pwd_category", [], "any", false, false, true, 26), "#markup", [], "array", false, false, true, 26)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_pwd_category", [], "any", false, false, true, 26), "html", null, true)));
        yield "</td></tr>
        <tr><th>Category Certificate</th><td>";
        // line 27
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_category_certificate", [], "any", false, true, true, 27), "#markup", [], "array", true, true, true, 27) &&  !(null === (($_v16 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_category_certificate", [], "any", false, false, true, 27)) && is_array($_v16) || $_v16 instanceof ArrayAccess && in_array($_v16::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v16["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_category_certificate", [], "any", false, false, true, 27), "#markup", [], "array", false, false, true, 27))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v17 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_category_certificate", [], "any", false, false, true, 27)) && is_array($_v17) || $_v17 instanceof ArrayAccess && in_array($_v17::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v17["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_category_certificate", [], "any", false, false, true, 27), "#markup", [], "array", false, false, true, 27)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_category_certificate", [], "any", false, false, true, 27), "html", null, true)));
        yield "</td></tr>
        <tr><th>Mobile Number</th><td>";
        // line 28
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_mobile_number", [], "any", false, true, true, 28), "#markup", [], "array", true, true, true, 28) &&  !(null === (($_v18 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_mobile_number", [], "any", false, false, true, 28)) && is_array($_v18) || $_v18 instanceof ArrayAccess && in_array($_v18::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v18["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_mobile_number", [], "any", false, false, true, 28), "#markup", [], "array", false, false, true, 28))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v19 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_mobile_number", [], "any", false, false, true, 28)) && is_array($_v19) || $_v19 instanceof ArrayAccess && in_array($_v19::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v19["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_mobile_number", [], "any", false, false, true, 28), "#markup", [], "array", false, false, true, 28)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_mobile_number", [], "any", false, false, true, 28), "html", null, true)));
        yield "</td></tr>
        <tr><th>Marital Status</th><td>";
        // line 29
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_marital_status", [], "any", false, true, true, 29), "#markup", [], "array", true, true, true, 29) &&  !(null === (($_v20 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_marital_status", [], "any", false, false, true, 29)) && is_array($_v20) || $_v20 instanceof ArrayAccess && in_array($_v20::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v20["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_marital_status", [], "any", false, false, true, 29), "#markup", [], "array", false, false, true, 29))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v21 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_marital_status", [], "any", false, false, true, 29)) && is_array($_v21) || $_v21 instanceof ArrayAccess && in_array($_v21::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v21["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_marital_status", [], "any", false, false, true, 29), "#markup", [], "array", false, false, true, 29)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_marital_status", [], "any", false, false, true, 29), "html", null, true)));
        yield "</td></tr>
        <tr><th>Nationality</th><td>";
        // line 30
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_nationality", [], "any", false, true, true, 30), "#markup", [], "array", true, true, true, 30) &&  !(null === (($_v22 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_nationality", [], "any", false, false, true, 30)) && is_array($_v22) || $_v22 instanceof ArrayAccess && in_array($_v22::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v22["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_nationality", [], "any", false, false, true, 30), "#markup", [], "array", false, false, true, 30))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v23 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_nationality", [], "any", false, false, true, 30)) && is_array($_v23) || $_v23 instanceof ArrayAccess && in_array($_v23::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v23["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_nationality", [], "any", false, false, true, 30), "#markup", [], "array", false, false, true, 30)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_nationality", [], "any", false, false, true, 30), "html", null, true)));
        yield "</td></tr>
        <tr><th>Alternate Phone</th><td>";
        // line 31
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_alternate_phone", [], "any", false, true, true, 31), "#markup", [], "array", true, true, true, 31) &&  !(null === (($_v24 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_alternate_phone", [], "any", false, false, true, 31)) && is_array($_v24) || $_v24 instanceof ArrayAccess && in_array($_v24::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v24["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_alternate_phone", [], "any", false, false, true, 31), "#markup", [], "array", false, false, true, 31))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v25 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_alternate_phone", [], "any", false, false, true, 31)) && is_array($_v25) || $_v25 instanceof ArrayAccess && in_array($_v25::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v25["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_alternate_phone", [], "any", false, false, true, 31), "#markup", [], "array", false, false, true, 31)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_alternate_phone", [], "any", false, false, true, 31), "html", null, true)));
        yield "</td></tr>
        <tr><th>Permanent Address</th><td>";
        // line 32
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_permanent_address", [], "any", false, true, true, 32), "#markup", [], "array", true, true, true, 32) &&  !(null === (($_v26 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_permanent_address", [], "any", false, false, true, 32)) && is_array($_v26) || $_v26 instanceof ArrayAccess && in_array($_v26::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v26["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_permanent_address", [], "any", false, false, true, 32), "#markup", [], "array", false, false, true, 32))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v27 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_permanent_address", [], "any", false, false, true, 32)) && is_array($_v27) || $_v27 instanceof ArrayAccess && in_array($_v27::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v27["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_permanent_address", [], "any", false, false, true, 32), "#markup", [], "array", false, false, true, 32)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_permanent_address", [], "any", false, false, true, 32), "html", null, true)));
        yield "</td></tr>
        <tr><th>Correspondence Address</th><td>";
        // line 33
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_correspondence_address", [], "any", false, true, true, 33), "#markup", [], "array", true, true, true, 33) &&  !(null === (($_v28 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_correspondence_address", [], "any", false, false, true, 33)) && is_array($_v28) || $_v28 instanceof ArrayAccess && in_array($_v28::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v28["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_correspondence_address", [], "any", false, false, true, 33), "#markup", [], "array", false, false, true, 33))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v29 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_correspondence_address", [], "any", false, false, true, 33)) && is_array($_v29) || $_v29 instanceof ArrayAccess && in_array($_v29::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v29["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_correspondence_address", [], "any", false, false, true, 33), "#markup", [], "array", false, false, true, 33)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_correspondence_address", [], "any", false, false, true, 33), "html", null, true)));
        yield "</td></tr>
        <tr><th>Departmental Candidate</th><td>";
        // line 34
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_departmental_candidate", [], "any", false, true, true, 34), "#markup", [], "array", true, true, true, 34) &&  !(null === (($_v30 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_departmental_candidate", [], "any", false, false, true, 34)) && is_array($_v30) || $_v30 instanceof ArrayAccess && in_array($_v30::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v30["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_departmental_candidate", [], "any", false, false, true, 34), "#markup", [], "array", false, false, true, 34))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v31 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_departmental_candidate", [], "any", false, false, true, 34)) && is_array($_v31) || $_v31 instanceof ArrayAccess && in_array($_v31::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v31["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_departmental_candidate", [], "any", false, false, true, 34), "#markup", [], "array", false, false, true, 34)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_departmental_candidate", [], "any", false, false, true, 34), "html", null, true)));
        yield "</td></tr>
        <tr><th>Experience Level</th><td>";
        // line 35
        yield (((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_experience_level", [], "any", false, true, true, 35), "#markup", [], "array", true, true, true, 35) &&  !(null === (($_v32 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_experience_level", [], "any", false, false, true, 35)) && is_array($_v32) || $_v32 instanceof ArrayAccess && in_array($_v32::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v32["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_experience_level", [], "any", false, false, true, 35), "#markup", [], "array", false, false, true, 35))))) ? ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, (($_v33 = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_experience_level", [], "any", false, false, true, 35)) && is_array($_v33) || $_v33 instanceof ArrayAccess && in_array($_v33::class, CoreExtension::ARRAY_LIKE_CLASSES, true) ? ($_v33["#markup"] ?? null) : CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_experience_level", [], "any", false, false, true, 35), "#markup", [], "array", false, false, true, 35)), "html", null, true)) : ($this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_experience_level", [], "any", false, false, true, 35), "html", null, true)));
        yield "</td></tr>
      </tbody>
    </table>
  </div>
</div>";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["content"]);        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--personal-information.html.twig";
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
        return array (  133 => 35,  129 => 34,  125 => 33,  121 => 32,  117 => 31,  113 => 30,  109 => 29,  105 => 28,  101 => 27,  97 => 26,  93 => 25,  89 => 24,  85 => 23,  81 => 22,  77 => 21,  73 => 20,  69 => 19,  60 => 13,  53 => 9,  44 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# filepath: themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--personal-information.html.twig #}
<div class=\"card shadow mb-4\">
  <div class=\"card-header bg-primary text-white\">
    Personal Information
  </div>
  <div class=\"card-body\">
    <div class=\"row mb-3\">
      <div class=\"col-md-3 text-center\">
        {{ content.field_photo }}
        <div class=\"small text-muted\">Photo</div>
      </div>
      <div class=\"col-md-3 text-center\">
        {{ content.field_signature }}
        <div class=\"small text-muted\">Signature</div>
      </div>
    </div>
    <table class=\"table table-bordered table-striped\">
      <tbody>
        <tr><th>Full Name</th><td>{{ content.field_full_name['#markup'] ?? content.field_full_name }}</td></tr>
        <tr><th>Date of Birth</th><td>{{ content.field_date_of_birth['#markup'] ?? content.field_date_of_birth }}</td></tr>
        <tr><th>Age</th><td>{{ content.field_age['#markup'] ?? content.field_age }}</td></tr>
        <tr><th>Father/Mother/Spouse Name</th><td>{{ content.field_father_mother_spouse_name['#markup'] ?? content.field_father_mother_spouse_name }}</td></tr>
        <tr><th>Email</th><td>{{ content.field_email['#markup'] ?? content.field_email }}</td></tr>
        <tr><th>Gender</th><td>{{ content.field_gender['#markup'] ?? content.field_gender }}</td></tr>
        <tr><th>Category</th><td>{{ content.field_category['#markup'] ?? content.field_category }}</td></tr>
        <tr><th>PWD Category</th><td>{{ content.field_pwd_category['#markup'] ?? content.field_pwd_category }}</td></tr>
        <tr><th>Category Certificate</th><td>{{ content.field_category_certificate['#markup'] ?? content.field_category_certificate }}</td></tr>
        <tr><th>Mobile Number</th><td>{{ content.field_mobile_number['#markup'] ?? content.field_mobile_number }}</td></tr>
        <tr><th>Marital Status</th><td>{{ content.field_marital_status['#markup'] ?? content.field_marital_status }}</td></tr>
        <tr><th>Nationality</th><td>{{ content.field_nationality['#markup'] ?? content.field_nationality }}</td></tr>
        <tr><th>Alternate Phone</th><td>{{ content.field_alternate_phone['#markup'] ?? content.field_alternate_phone }}</td></tr>
        <tr><th>Permanent Address</th><td>{{ content.field_permanent_address['#markup'] ?? content.field_permanent_address }}</td></tr>
        <tr><th>Correspondence Address</th><td>{{ content.field_correspondence_address['#markup'] ?? content.field_correspondence_address }}</td></tr>
        <tr><th>Departmental Candidate</th><td>{{ content.field_departmental_candidate['#markup'] ?? content.field_departmental_candidate }}</td></tr>
        <tr><th>Experience Level</th><td>{{ content.field_experience_level['#markup'] ?? content.field_experience_level }}</td></tr>
      </tbody>
    </table>
  </div>
</div>", "themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--personal-information.html.twig", "/var/www/html/jobportal/themes/contrib/bootstrap/subthemes/bootstrap_sass/templates/node--personal-information.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = [];
        static $filters = ["escape" => 9];
        static $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
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
