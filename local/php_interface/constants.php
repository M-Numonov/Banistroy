<?
define("IS_INDEX", ($APPLICATION->GetCurPage() == SITE_DIR) ? (true) : (false));
define("IBLOCK_FORMS_ID", 9);

define("MATERIALS_SECTION", 38);
define("FUNDAMENT_SECTION", 39);
define("ROOFS_SECTION", 40);

define("MATERIALS_IBLOCK_ID", 4);
define("PS_IBLOCK_ID", 11);
define("PROJECTS_IBLOCK_ID", 7);
define("MATERIALS_SECTION_ID", 38);
define("SKU_IBLOCK_ID", 12);
define("CUSTOM_SECTIONS", array(36, 37));
define("PRODUCTS_I_SERVICES", (CSite::InDir('/products_i_services/') ? (true) : (false)));
define("IS_PROEKTI", (CSite::InDir('/proekti/') ? (true) : (false)));
define("MATERIALS", ($APPLICATION->GetCurPage() == '/materials/') ? (true) : (false));
define("LEFT_MENU_BUILDING_HOMES_SECTION_ID", 18);
define("LEFT_MENU_BUILDING_BAN_SECTION_ID", 17);
define("LEFT_MENU_BUILDING_SERVICES_SECTION_ID", 6);
define("LEFT_MENU_BUILDING_MATERIALS_SECTION_ID", 38);

define("PROPERTY_MATERIAL", 26);
define("PROPERTY_FUNDAMENT", 27);
define("PROPERTY_ROOF", 28);
define("PROPERTY_MATERIAL_CAPACITY", 31);
define("PROPERTY_FUNDAMENT_CAPACITY", 32);
define("PROPERTY_ROOF_CAPACITY", 33);
define("PROPERTY_DISCOUNT", 34);
define("PROPERTY_PRICE", 6);

define("ERROR_PAGE", ((defined('ERROR_404') && ERROR_404 == 'Y') || (CHTTP::GetLastStatus() == "404 Not Found")) ? (true) : (false));
$section_class = "";
if (IS_INDEX) {
    $section_class = "dec-bg";
} elseif (CSite::InDir('/reviews/') || (ERROR_PAGE) || CSite::InDir('/products_i_services/') || CSite::InDir('/proekti/') || CSite::InDir('/search/')) {
    $section_class = "indent-small";
} elseif (CSite::InDir('/articles/') || CSite::InDir('/article/') || CSite::InDir('/faqs/')) {
    $section_class = "indent-small dec-right";
} elseif (CSite::InDir('/contacts/') || CSite::InDir('/materials/')) {
    $section_class = "indent-small dec-right-green";
} elseif (CSite::InDir('/gallery/')) {
    $section_class = "indent-small dec-top-green";
}
define("SECTION_CLASS", $section_class);
?>