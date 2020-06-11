<!DOCTYPE html>
<html lang="en">
<head>

    <title><?$APPLICATION->ShowTitle()?></title>
    <meta content="width=device-width,maximum-scale=1,initial-scale=1,user-scalable=0" name="viewport">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="author" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/bootstrap.css')?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/lightgallery.css')?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/main.css')?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/screen.css')?>
    <?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/custom.css')?>
   <link href="/favicon.ico" rel="shortcut icon"/>
<?$APPLICATION->ShowHead()?>
</head>

<body>
<?$APPLICATION->ShowPanel()?>
<!-- wrapper Start -->
<div class="wrapper">
    <!-- header Start -->
    <header class="header">
        <div class="header__top-panel">
            <div class="container">
                <div class="header__top-panel__in">

                    <a href="#" class="leave-request" data-toggle="modal" data-target="#modal">Оставить заявку</a>
                    <ul class="header__info-list">
                        <li class="phone">
                            <?
                            $APPLICATION->IncludeFile(
                              $APPLICATION->GetTemplatePath("/include_areas/phone.php"),
                              Array(),
                              Array("MODE"=>"html")
                            );
                            ?>
                        </li>
                        <li>
                            <?$APPLICATION->IncludeComponent("bitrix:search.title", "search_top", Array(
                                "CATEGORY_0" => "",	// Ограничение области поиска
                                "CATEGORY_0_TITLE" => "",	// Название категории
                                "CHECK_DATES" => "N",	// Искать только в активных по дате документах
                                "CONTAINER_ID" => "title-search",	// ID контейнера, по ширине которого будут выводиться результаты
                                "INPUT_ID" => "title-search-input",	// ID строки ввода поискового запроса
                                "NUM_CATEGORIES" => "1",	// Количество категорий поиска
                                "ORDER" => "date",	// Сортировка результатов
                                "PAGE" => "#SITE_DIR#search/index.php",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
                                "SHOW_INPUT" => "Y",	// Показывать форму ввода поискового запроса
                                "SHOW_OTHERS" => "N",	// Показывать категорию "прочее"
                                "TOP_COUNT" => "5",	// Количество результатов в каждой категории
                                "USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
                            ),
                                false
                            );?>
                        </li>
                    </ul>
                    <div class="logo">
<!--                        <a href="/" data-toggle="modal" data-target="#modal2">Банистрой</a>-->
                        <a href="/">Банистрой</a>
                    </div>
                    <span class="main-navi-btn"></span>
                </div>
            </div>
        </div>
        <div class="header__bottom-panel"  data-menu="menu">
            <div class="container">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "top_multilevel_menu",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "2",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "top",
                        "USE_EXT" => "Y",
                        "COMPONENT_TEMPLATE" => "top_multilevel_menu"
                    ),
                    false
                );?>
            </div>
        </div>
    </header>
    <!-- header end -->
    <?if (IS_INDEX):?>
    <!-- promo Start -->

        <?
        global $arFilter;
        $arFilter = [
                "PROPERTY_SLIDE_TYPE_VALUE"=>"верхний"
        ]
        ?>
        <?$APPLICATION->IncludeComponent("bitrix:news.list", "news_list_slider", Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
            "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
            "AJAX_MODE" => "N",	// Включить режим AJAX
            "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
            "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
            "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
            "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
            "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
            "CACHE_GROUPS" => "Y",	// Учитывать права доступа
            "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
            "CACHE_TYPE" => "A",	// Тип кеширования
            "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
            "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
            "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
            "DISPLAY_DATE" => "Y",	// Выводить дату элемента
            "DISPLAY_NAME" => "Y",	// Выводить название элемента
            "DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
            "DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
            "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
            "FIELD_CODE" => array(	// Поля
                0 => "",
                1 => "",
            ),
            "FILTER_NAME" => "arFilter",	// Фильтр
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
            "IBLOCK_ID" => "2",	// Код информационного блока
            "IBLOCK_TYPE" => "info",	// Тип информационного блока (используется только для проверки)
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
            "INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
            "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
            "NEWS_COUNT" => "10",	// Количество новостей на странице
            "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
            "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
            "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
            "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
            "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
            "PAGER_TITLE" => "Слайдер",	// Название категорий
            "PARENT_SECTION" => "",	// ID раздела
            "PARENT_SECTION_CODE" => "",	// Код раздела
            "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
            "PROPERTY_CODE" => array(	// Свойства
                0 => "SLIDE_TYPE",
                1 => "",
            ),
            "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
            "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
            "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
            "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
            "SET_STATUS_404" => "N",	// Устанавливать статус 404
            "SET_TITLE" => "N",	// Устанавливать заголовок страницы
            "SHOW_404" => "N",	// Показ специальной страницы
            "SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
            "SORT_BY2" => "ID",	// Поле для второй сортировки новостей
            "SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
            "SORT_ORDER2" => "DESC",	// Направление для второй сортировки новостей
            "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
        ),
            false
        );?>
    <!-- promo end -->
    <?endif;?>
    <!-- page Start -->
    <div class="page">
        <section class="section <?=SECTION_CLASS?> <?$APPLICATION->ShowViewContent('SECTION_CLASS');?>">
            <div class="container">
                <?if (!IS_INDEX && !defined("ERROR_404")):?>
                    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumb", Array(
                        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                        "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                        "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                    ),
                        false
                    );?>
                <?if (!PRODUCTS_I_SERVICES && !MATERIALS):?>
                    <h2 class="global-title"><?$APPLICATION->ShowTitle()?></h2>
                <?else:?>
                        </div>
                        <?$APPLICATION->ShowViewContent('TITLE');?>
                <?endif;?>
                <?endif;?>
