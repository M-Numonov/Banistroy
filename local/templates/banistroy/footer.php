<?if (!MATERIALS):?>
</div>
<?endif;?>
</section>

<? if (IS_INDEX): ?>


    <?
    global $arFilter_center;
    $arFilter_center = [
        "PROPERTY_SLIDE_TYPE_VALUE" => "Центральный"
    ]
    ?>
    <? $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "news_list_slider_2",
        array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
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
                0 => "",
                1 => "PREVIEW_PICTURE",
                2 => "",
            ),
            "FILTER_NAME" => "arFilter_center",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "2",
            "IBLOCK_TYPE" => "info",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "N",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "10",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Слайдер",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(
                0 => "SLIDE_TYPE",
                1 => "",
            ),
            "SET_BROWSER_TITLE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "SORT",
            "SORT_BY2" => "ID",
            "SORT_ORDER1" => "ASC",
            "SORT_ORDER2" => "DESC",
            "STRICT_SECTION_CHECK" => "N",
            "COMPONENT_TEMPLATE" => "news_list_slider_2"
        ),
        false
    ); ?>


    <? $APPLICATION->IncludeComponent("bitrix:news.list", "news_list_articles_home", Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
        "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
        "AJAX_MODE" => "N",    // Включить режим AJAX
        "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
        "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
        "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
        "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
        "CACHE_GROUPS" => "Y",    // Учитывать права доступа
        "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
        "CACHE_TYPE" => "A",    // Тип кеширования
        "CHECK_DATES" => "Y",    // Показывать только активные на данный момент элементы
        "DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
        "DISPLAY_BOTTOM_PAGER" => "N",    // Выводить под списком
        "DISPLAY_DATE" => "Y",    // Выводить дату элемента
        "DISPLAY_NAME" => "Y",    // Выводить название элемента
        "DISPLAY_PICTURE" => "Y",    // Выводить изображение для анонса
        "DISPLAY_PREVIEW_TEXT" => "Y",    // Выводить текст анонса
        "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
        "FIELD_CODE" => array(    // Поля
            0 => "",
            1 => "",
        ),
        "FILTER_NAME" => "",    // Фильтр
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",    // Скрывать ссылку, если нет детального описания
        "IBLOCK_ID" => "8",    // Код информационного блока
        "IBLOCK_TYPE" => "info",    // Тип информационного блока (используется только для проверки)
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
        "INCLUDE_SUBSECTIONS" => "N",    // Показывать элементы подразделов раздела
        "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
        "NEWS_COUNT" => "20",    // Количество новостей на странице
        "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
        "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
        "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
        "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
        "PAGER_TITLE" => "Новости",    // Название категорий
        "PARENT_SECTION" => "",    // ID раздела
        "PARENT_SECTION_CODE" => "",    // Код раздела
        "PREVIEW_TRUNCATE_LEN" => "",    // Максимальная длина анонса для вывода (только для типа текст)
        "PROPERTY_CODE" => array(    // Свойства
            0 => "",
            1 => "",
        ),
        "SET_BROWSER_TITLE" => "N",    // Устанавливать заголовок окна браузера
        "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
        "SET_META_DESCRIPTION" => "N",    // Устанавливать описание страницы
        "SET_META_KEYWORDS" => "N",    // Устанавливать ключевые слова страницы
        "SET_STATUS_404" => "N",    // Устанавливать статус 404
        "SET_TITLE" => "N",    // Устанавливать заголовок страницы
        "SHOW_404" => "N",    // Показ специальной страницы
        "SORT_BY1" => "ID",    // Поле для первой сортировки новостей
        "SORT_BY2" => "SORT",    // Поле для второй сортировки новостей
        "SORT_ORDER1" => "DESC",    // Направление для первой сортировки новостей
        "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
        "STRICT_SECTION_CHECK" => "N",    // Строгая проверка раздела для показа списка
    ),
        false
    ); ?>
<? endif; ?>
</div>
<!-- page end -->
<!-- footer Start -->
<footer class="footer">
    <div class="footer__top-panel">
        <div class="container">
            <div class="footer__top-panel__in">
                <ul class="footer__list">
                    <li class="footer__list__item big-size">
                        <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_menu_green", Array(
                            "TITLE" => "Строительство домов",
                            "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                            "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                            "DELAY" => "N",	// Откладывать выполнение шаблона меню
                            "MAX_LEVEL" => "1",	// Уровень вложенности меню
                            "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                0 => "",
                            ),
                            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                            "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                            "ROOT_MENU_TYPE" => "building_home",	// Тип меню для первого уровня
                            "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                        ),
                            false
                        );?>
                    </li>
                    <li class="footer__list__item big-size">
                        <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"footer_menu_green", 
	array(
		"TITLE" => "Строительство бань",
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "building_bath",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "footer_menu_green"
	),
	false
);?>
                    </li>
                    <li class="footer__list__item">
                        <?$APPLICATION->IncludeComponent("bitrix:menu", "footer_menu_balck", Array(
                            "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                            "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                            "DELAY" => "N",	// Откладывать выполнение шаблона меню
                            "MAX_LEVEL" => "1",	// Уровень вложенности меню
                            "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                            "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                            "ROOT_MENU_TYPE" => "footer_cutom",	// Тип меню для первого уровня
                            "USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                            "COMPONENT_TEMPLATE" => "footer_menu_green"
                        ),
                            false
                        );?>
                    </li>
                    <li class="footer__list__item big-size">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "footer_menu_green",
                            array(
                                "TITLE" => "Услуги",
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "footer_services",
                                "USE_EXT" => "Y",
                                "COMPONENT_TEMPLATE" => "footer_menu_green"
                            ),
                            false
                        );?>
                    </li>
                    <li class="footer__list__item big-size">
                        <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"footer_menu_green", 
	array(
		"TITLE" => "Цены на материалы",
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "footer_materials",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "footer_materials",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "footer_menu_green"
	),
	false
);?>
                    </li>
                    <li class="width_10 footer__list__item big-size">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "footer_menu_green",
                            array(
                                "TITLE" => "Еще",
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "1",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "footer_more",
                                "USE_EXT" => "Y",
                                "COMPONENT_TEMPLATE" => "footer_menu_green"
                            ),
                            false
                        );?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer__bottom-panel">
        <div class="container">
            <div class="footer__bottom-panel__in">
                <?
                $APPLICATION->IncludeFile(
                    $APPLICATION->GetTemplatePath("/include_areas/copyright.php"),
                    Array(),
                    Array("MODE" => "html")
                );
                ?>
                <span class="development"><a href="#">Создание сайта</a> - Компания “Веб Пульт”</span>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->
<!-- wrapper end -->

<!-- modal Start -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-content__in">
                <h2 class="global-title error_formv_title">Проконсультируем вас по любым вопросам</h2>
                    <p class="error_formv"></p>
                <form id="orderCallback" method="post" action="/ajax/forms.php"
                      onsubmit="sendFormCallback(); return false;">
                    <fieldset>
                        <label class="global-label">Имя <span>*</span></label>
                        <input class="global-input" name="fio" required type="text"/>
                    </fieldset>
                    <fieldset>
                        <label class="global-label">Телефон <span>*</span></label>
                        <input class="global-input phone_for_inputmask" required name="phone" type="text"/>
                    </fieldset>
                    <fieldset>
                        <div class="checkbox">
                            <input id="feedback" type="checkbox">
                            <label for="feedback">
                                <span class="checkbox__box">&nbsp;</span>
                                <span class="checkbox__text">Нажимая кнопку "Оставить отзыв", вы принимаете <a href="#">условия обработки персональных данных.</a></span>
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="text-center">
                        <button class="dec-btn" type="submit">
                            <span>Оставить отзыв</span>
                        </button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->

<!-- modal Start -->
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-content__in text-center">
                <h2 class="global-title indent-bt-sm">Спасибо</h2>
                <span class="notification__text">Ваша заявка принята</span>
                <a href="#" class="dec-btn" data-dismiss="modal" aria-hidden="true">
                    <span>Ок</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->



<!-- jQuery libs -->
<script type="text/javascript" src="<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery.js") ?>"></script>
<script type="text/javascript" src="<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/jquery-ui.js") ?>"></script>
<script type="text/javascript" src="<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/bootstrap.js") ?>"></script>
<script type="text/javascript" src="<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/slick.js") ?>"></script>
<script type="text/javascript" src="<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/inputmask.js") ?>"></script>
<?if (IS_PROEKTI):?>
<script type="text/javascript" src="<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/filter-slider.js") ?>"></script>
<?endif;?>
<script type="text/javascript" src="<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/lightgallery-all.min.js") ?>"></script>
<script type="text/javascript" src="<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/scripts.js") ?>"></script>
<script type="text/javascript" src="<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/js/custom.js") ?>"></script>

</body>
</html>