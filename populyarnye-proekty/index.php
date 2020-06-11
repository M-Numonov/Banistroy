<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Популярные проекты");
?>

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
                    "TYPE"=>"P",
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

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>