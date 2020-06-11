<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$ids = [];
foreach ($arResult["SEARCH"] as $s){
    $ids[] = $s["ITEM_ID"];
}
global $arFilter;
$arFilter = [
    "ID"=>$ids
];
if ($arParams["TYPE"]=="P"){
    $arFilter["PROPERTY_POPULAR"]=1;
}
if ($arParams["TYPE"]=="A"){
    $arFilter["PROPERTY_DISCOUNT"]=1;
}
?>
<?
$intSectionID = $APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	".default", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "7",
		"ELEMENT_SORT_FIELD" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "sort",
		"ELEMENT_SORT_ORDER2" => "asc",
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"PROPERTY_CODE_MOBILE" => array(
			0 => "AREA",
			1 => "GABARIT",
		),
		"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => "-",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"BASKET_URL" => "",
		"ACTION_VARIABLE" => "",
		"PRODUCT_ID_VARIABLE" => "",
		"SECTION_ID_VARIABLE" => "",
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
		"FILTER_NAME" => "arFilter",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "Y",
		"MESSAGE_404" => $arParams["~MESSAGE_404"],
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"FILE_404" => "",
		"DISPLAY_COMPARE" => "N",
		"PAGE_ELEMENT_COUNT" => "9",
		"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
		"PRICE_CODE" => array(
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "",
		"PRICE_VAT_INCLUDE" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"])?$arParams["PRODUCT_PROPERTIES"]:[]),
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "show_more",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"LAZY_LOAD" => "N",
		"MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
		"LOAD_ON_SCROLL" => "N",
		"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"])?$arParams["OFFERS_CART_PROPERTIES"]:[]),
		"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"])?$arParams["LIST_OFFERS_PROPERTY_CODE"]:[]),
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
		"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
		"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
		"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"])?$arParams["LIST_OFFERS_LIMIT"]:0),
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"SECTION_URL" => "",
		"DETAIL_URL" => "",
		"USE_MAIN_ELEMENT_SECTION" => "Y",
		"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
		"CURRENCY_ID" => $arParams["CURRENCY_ID"],
		"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
		"HIDE_NOT_AVAILABLE_OFFERS" => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
		"LABEL_PROP" => array(
		),
		"LABEL_PROP_MOBILE" => $arParams["LABEL_PROP_MOBILE"],
		"LABEL_PROP_POSITION" => $arParams["LABEL_PROP_POSITION"],
		"ADD_PICT_PROP" => "-",
		"PRODUCT_DISPLAY_MODE" => $arParams["PRODUCT_DISPLAY_MODE"],
		"PRODUCT_BLOCKS_ORDER" => $arParams["LIST_PRODUCT_BLOCKS_ORDER"],
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"ENLARGE_PRODUCT" => "STRICT",
		"ENLARGE_PROP" => isset($arParams["LIST_ENLARGE_PROP"])?$arParams["LIST_ENLARGE_PROP"]:"",
		"SHOW_SLIDER" => "N",
		"SLIDER_INTERVAL" => isset($arParams["LIST_SLIDER_INTERVAL"])?$arParams["LIST_SLIDER_INTERVAL"]:"",
		"SLIDER_PROGRESS" => isset($arParams["LIST_SLIDER_PROGRESS"])?$arParams["LIST_SLIDER_PROGRESS"]:"",
		"OFFER_ADD_PICT_PROP" => $arParams["OFFER_ADD_PICT_PROP"],
		"OFFER_TREE_PROPS" => (isset($arParams["OFFER_TREE_PROPS"])?$arParams["OFFER_TREE_PROPS"]:[]),
		"PRODUCT_SUBSCRIPTION" => $arParams["PRODUCT_SUBSCRIPTION"],
		"SHOW_DISCOUNT_PERCENT" => $arParams["SHOW_DISCOUNT_PERCENT"],
		"DISCOUNT_PERCENT_POSITION" => $arParams["DISCOUNT_PERCENT_POSITION"],
		"SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
		"SHOW_MAX_QUANTITY" => $arParams["SHOW_MAX_QUANTITY"],
		"MESS_SHOW_MAX_QUANTITY" => (isset($arParams["~MESS_SHOW_MAX_QUANTITY"])?$arParams["~MESS_SHOW_MAX_QUANTITY"]:""),
		"RELATIVE_QUANTITY_FACTOR" => (isset($arParams["RELATIVE_QUANTITY_FACTOR"])?$arParams["RELATIVE_QUANTITY_FACTOR"]:""),
		"MESS_RELATIVE_QUANTITY_MANY" => (isset($arParams["~MESS_RELATIVE_QUANTITY_MANY"])?$arParams["~MESS_RELATIVE_QUANTITY_MANY"]:""),
		"MESS_RELATIVE_QUANTITY_FEW" => (isset($arParams["~MESS_RELATIVE_QUANTITY_FEW"])?$arParams["~MESS_RELATIVE_QUANTITY_FEW"]:""),
		"MESS_BTN_BUY" => "",
		"MESS_BTN_ADD_TO_BASKET" => "",
		"MESS_BTN_SUBSCRIBE" => "",
		"MESS_BTN_DETAIL" => "",
		"MESS_NOT_AVAILABLE" => "",
		"MESS_BTN_COMPARE" => (isset($arParams["~MESS_BTN_COMPARE"])?$arParams["~MESS_BTN_COMPARE"]:""),
		"USE_ENHANCED_ECOMMERCE" => "N",
		"DATA_LAYER_NAME" => (isset($arParams["DATA_LAYER_NAME"])?$arParams["DATA_LAYER_NAME"]:""),
		"BRAND_PROPERTY" => (isset($arParams["BRAND_PROPERTY"])?$arParams["BRAND_PROPERTY"]:""),
		"TEMPLATE_THEME" => "",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => $basketAction,
		"SHOW_CLOSE_POPUP" => isset($arParams["COMMON_SHOW_CLOSE_POPUP"])?$arParams["COMMON_SHOW_CLOSE_POPUP"]:"",
		"COMPARE_PATH" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
		"COMPARE_NAME" => $arParams["COMPARE_NAME"],
		"USE_COMPARE_LIST" => "Y",
		"BACKGROUND_IMAGE" => "",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"COMPONENT_TEMPLATE" => ".default",
		"SECTION_USER_FIELDS" => array(
			0 => "UF_PRICE",
			1 => "",
		),
		"SHOW_ALL_WO_SECTION" => "Y",
		"RCM_TYPE" => "personal",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"SHOW_FROM_SECTION" => "Y",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y"
	),
	false
);
?>