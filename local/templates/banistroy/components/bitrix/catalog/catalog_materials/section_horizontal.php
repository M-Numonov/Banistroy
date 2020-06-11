<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

global $APPLICATION;
$s = CIBlockSection::GetByID($arCurSection["ID"])->GetNext();
$APPLICATION->SetPageProperty("TITLE", $s["NAME"]);

$APPLICATION->AddChainItem($s["NAME"], $s["SECTION_PAGE_URL"]);

$res = CIBlockSection::GetList([], ["IBLOCK_ID" => PS_IBLOCK_ID, "ID" => $arCurSection["ID"]], false, ["UF_*"]);
if ($ar_res = $res->GetNextElement()) {
    $section = $ar_res->GetFields();
    $section["PROPS"] = $ar_res->GetProperties();
}
?>

<? $this->SetViewTarget("TITLE") ?>
<? if ($section["UF_BG_IMAGE"]): ?>
<div class="info-b" style="background-image: url(<?= CFile::GetPath($section["UF_BG_IMAGE"]) ?>)">
    <? else: ?>
    <div class="info-b" style="background-image: url(/local/templates/banistroy/img/src/info-bg.jpg)">
        <? endif; ?>
        <div class="container">
            <div class="info-b__content">
                <? if (strlen($section["UF_SEO_TITLE"]) > 1): ?>
                    <h2 class="global-title"><?= $section["UF_SEO_TITLE"] ?></h2>
                <? else: ?>
                    <h2 class="global-title"><?= $section["NAME"] ?></h2>
                <? endif; ?>
            </div>
        </div>
    </div>
    <? $this->EndViewTarget(); ?>
    <div class="construction">
        <div class="container">
            <div class="construction__in">
                <? $APPLICATION->IncludeComponent("bitrix:menu", "menu_in_products", Array(
                    "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                    "CHILD_MENU_TYPE" => "no_menu",    // Тип меню для остальных уровней
                    "DELAY" => "N",    // Откладывать выполнение шаблона меню
                    "MAX_LEVEL" => "2",    // Уровень вложенности меню
                    "MENU_CACHE_GET_VARS" => array(    // Значимые переменные запроса
                        0 => "",
                    ),
                    "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                    "MENU_CACHE_TYPE" => "N",    // Тип кеширования
                    "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                    "ROOT_MENU_TYPE" => "products_inner",    // Тип меню для первого уровня
                    "USE_EXT" => "N",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                ),
                    false
                ); ?>

                <?= $section["~DESCRIPTION"] ?>
            </div>
        </div>
    </div>
    <div class="construction-info">
        <div class="container">
            <? if ($section["UF_SEO_PROJECTS"] || $section["UF_SECTION_PROJECTS"] || $section["UF_PROJECTS_METERIAL"]): ?>

                <h2 class="global-title"><?= $section["UF_TITLE_FOR_SLIDER"] ?></h2>

                <?
                global $arFilter;
                if ($section["UF_PROJECTS_METERIAL"]){
                    $arFilter["PROPERTY_LINK_TO_MATERIAL"] = $section["UF_PROJECTS_METERIAL"];
                    $section["UF_SECTION_PROJECTS"] = "";
                }elseif ($section["UF_SEO_PROJECTS"]){
                    $section["UF_SECTION_PROJECTS"] = "";
                    $arFilter["ID"] = $section["UF_SEO_PROJECTS"];
                }
                ?>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "projects_slider",
                    array(
                        "ACTIVE_DATE_FORMAT" => "j F Y",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array(
                            0 => "TAGS",
                            1 => "",
                        ),
                        "FILTER_NAME" => "arFilter",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "7",
                        "IBLOCK_TYPE" => "catalog",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "20",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Новости",
                        "PARENT_SECTION" => $section["UF_SECTION_PROJECTS"],
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array(
                            0 => "GABARIT",
                            1 => "AREA",
                            2 => "",
                        ),
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "ID",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER1" => "DESC",
                        "SORT_ORDER2" => "ASC",
                        "STRICT_SECTION_CHECK" => "N",
                        "COMPONENT_TEMPLATE" => "projects_slider"
                    ),
                    false
                ); ?>



            <? endif; ?>
            <?= $section["~UF_SEO_TEXT_HTML"] ?>

            <div class="info-panel">
                <p>
                    Обратившись в компанию «Банистрой», вы получите развернутые ответы на все возникшие вопросы.
                    Наши специалисты порекомендуют, какой из имеющихся типовых проектов будет оптимальным в конкретной
                    ситуации.
                </p>
                <ul class="info-panel__list">
                    <li>
                        <a href="/projects/" class="dec-btn big-size">
                            <span>Подобрать проект дома</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#modal" class="dec-btn big-size dark-bg">
                            <span>Заказать звонок</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>