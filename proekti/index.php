<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Проекты");
?>

<?
$curpage = $APPLICATION->GetCurPage();
?>

<?if ($_REQUEST["tags"]):?>

	<div class="projects-col__left">
		<?
		$curpage = $APPLICATION->GetCurPage();
		?>
		<?$APPLICATION->IncludeComponent("bitrix:search.tags.cloud", "tags_cloud", Array(
			"CACHE_TIME" => "3600",	// Время кеширования (сек.)
			"CACHE_TYPE" => "A",	// Тип кеширования
			"CHECK_DATES" => "N",	// Искать только в активных по дате документах
			"COLOR_NEW" => "3E74E6",	// Цвет более позднего тега (пример: "C0C0C0")
			"COLOR_OLD" => "C0C0C0",	// Цвет более раннего тега (пример: "FEFEFE")
			"COLOR_TYPE" => "Y",	// Плавное изменение цвета
			"FILTER_NAME" => "",	// Дополнительный фильтр
			"FONT_MAX" => "50",	// Максимальный размер шрифта (px)
			"FONT_MIN" => "10",	// Минимальный  размер шрифта (px)
			"PAGE_ELEMENTS" => "150",	// Количество тегов
			"PERIOD" => "",	// Период выборки тегов (дней)
			"PERIOD_NEW_TAGS" => "",	// Период,  в течение которого считать тег новым (дней)
			"SHOW_CHAIN" => "Y",	// Показывать цепочку навигации
			"SORT" => "NAME",	// Сортировка тегов
			"TAGS_INHERIT" => "Y",	// Сужать область поиска
			"URL_SEARCH" => $curpage,	// Путь к странице поиска (от корня сайта)
			"WIDTH" => "100%",	// Ширина облака тегов (пример: "100%" или "100px", "100pt", "100in")
			"arrFILTER" => array(	// Ограничение области поиска
				0 => "iblock_catalog",
			),
			"arrFILTER_iblock_catalog" => array(	// Искать в информационных блоках типа "iblock_catalog"
				0 => "7",
			)
		),
			false
		);?>

	</div>
	<div class="projects-col__right">
	<?$APPLICATION->IncludeComponent(
		"bitrix:search.page",
		".default",
		array(
			"CHECK_DATES" => "N",
			"arrWHERE" => array(
				0 => "iblock_".$arParams["IBLOCK_TYPE"],
			),
			"arrFILTER" => array(
				0 => "iblock_catalog",
			),
			"SHOW_WHERE" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"={\"arrFILTER_iblock_\".\$arParams[\"IBLOCK_TYPE\"]}" => array(
				0 => $arParams["IBLOCK_ID"],
			),
			"COMPONENT_TEMPLATE" => ".default",
			"RESTART" => "N",
			"NO_WORD_LOGIC" => "N",
			"USE_TITLE_RANK" => "N",
			"DEFAULT_SORT" => "rank",
			"FILTER_NAME" => "arrFilter",
			"arrFILTER_iblock_catalog" => array(
				0 => "7",
			),
			"SHOW_WHEN" => "N",
			"PAGE_RESULT_COUNT" => "50",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"USE_LANGUAGE_GUESS" => "Y",
			"USE_SUGGEST" => "N",
			"DISPLAY_TOP_PAGER" => "Y",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"PAGER_TITLE" => "Результаты поиска",
			"PAGER_SHOW_ALWAYS" => "Y",
			"PAGER_TEMPLATE" => ""
		),
		$component
	);?>
	</div>

<?else:?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"catalog_projects", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "catalog_projects",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"DETAIL_BRAND_USE" => "N",
		"DETAIL_BROWSER_TITLE" => "-",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"DETAIL_DETAIL_PICTURE_MODE" => array(
			0 => "POPUP",
			1 => "MAGNIFIER",
		),
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"DETAIL_IMAGE_RESOLUTION" => "16by9",
		"DETAIL_MAIN_BLOCK_PROPERTY_CODE" => array(
			0 => "MORE_PHOTO",
		),
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
		"DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"DETAIL_SHOW_POPULAR" => "N",
		"DETAIL_SHOW_SLIDER" => "N",
		"DETAIL_SHOW_VIEWED" => "N",
		"DETAIL_SLIDER_INTERVAL" => "5000",
		"DETAIL_SLIDER_PROGRESS" => "N",
		"DETAIL_STRICT_SECTION_CHECK" => "N",
		"DETAIL_USE_COMMENTS" => "N",
		"DETAIL_USE_VOTE_RATING" => "N",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILE_404" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "NAME",
			1 => "",
		),
		"FILTER_HIDE_ON_MOBILE" => "N",
		"FILTER_NAME" => "arFilter",
		"FILTER_PRICE_CODE" => array(
			0 => "NEW",
			1 => "POPULAR",
			2 => "XIT",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "NEW",
			1 => "AREA",
			2 => "SIZE",
			3 => "PRICE",
			4 => "FLOOR",
			5 => "POPULAR",
			6 => "XIT",
			7 => "",
		),
		"FILTER_VIEW_MODE" => "HORIZONTAL",
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"INSTANT_RELOAD" => "Y",
		"LABEL_PROP" => array(
			0 => "TYPE",
		),
		"LABEL_PROP_MOBILE" => array(
		),
		"LABEL_PROP_POSITION" => "top-left",
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_PROPERTY_SID" => "",
		"LIST_BROWSER_TITLE" => "-",
		"LIST_ENLARGE_PRODUCT" => "STRICT",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_META_KEYWORDS" => "-",
		"LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"LIST_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"LIST_PROPERTY_CODE" => array(
			0 => "AREA",
			1 => "POPULAR",
			2 => "SIZE",
			3 => "PRICE",
			4 => "FLOOR",
		),
		"LIST_PROPERTY_CODE_MOBILE" => array(
		),
		"LIST_SHOW_SLIDER" => "N",
		"LIST_SLIDER_INTERVAL" => "3000",
		"LIST_SLIDER_PROGRESS" => "N",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"PAGER_BASE_LINK" => "",
		"PAGER_BASE_LINK_ENABLE" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_PARAMS_NAME" => "arrPager",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "show_more",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "9",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"PRICE_CODE" => array(
			0 => "NEW",
			1 => "PRICE",
			2 => "POPULAR",
			3 => "XIT",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"SEARCH_CHECK_DATES" => "Y",
		"SEARCH_NO_WORD_LOGIC" => "Y",
		"SEARCH_PAGE_RESULT_COUNT" => "50",
		"SEARCH_RESTART" => "Y",
		"SEARCH_USE_LANGUAGE_GUESS" => "Y",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",
		"SECTIONS_VIEW_MODE" => "LIST",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_TOP_DEPTH" => "1",
		"SEF_FOLDER" => "/proekti/",
		"SEF_MODE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "Y",
		"SHOW_DEACTIVATED" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_TOP_ELEMENTS" => "N",
		"SIDEBAR_DETAIL_SHOW" => "Y",
		"SIDEBAR_PATH" => "",
		"SIDEBAR_SECTION_SHOW" => "Y",
		"TEMPLATE_THEME" => "blue",
		"TOP_ELEMENT_COUNT" => "9",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_FIELD2" => "id",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_ORDER2" => "desc",
		"TOP_ENLARGE_PRODUCT" => "STRICT",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
		"TOP_SHOW_SLIDER" => "Y",
		"TOP_SLIDER_INTERVAL" => "3000",
		"TOP_SLIDER_PROGRESS" => "N",
		"TOP_VIEW_MODE" => "SECTION",
		"USER_CONSENT" => "Y",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "N",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_COMPARE" => "N",
		"USE_ELEMENT_COUNTER" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_FILTER" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "Y",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"USE_REVIEW" => "N",
		"USE_STORE" => "N",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE#/",
			"element" => "#SECTION_CODE#/#ELEMENT_CODE#/",
			"compare" => "",
			"smart_filter" => "#SECTION_ID#/filter/#SMART_FILTER_PATH#/apply/",
		)
	),
	false
);?>
<?endif;?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>