<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$cur_page = $APPLICATION->GetCurPage();
?>
<?if ($arResult["MENU"]):?>
    <nav class="main-navi">
        <ul class="main-navi__in">
            <?foreach ($arResult["MENU"] as $men):?>
            <?/*if ($men["LINK"] == "/projects/"):*/?><!--
            <li class="main-navi__item <?/*=*/?>arrow-i active">
                <a  href="<?/*=$men["LINK"]*/?>"><?/*=$men["NAME"]*/?></a>
                <div class="main-navi__item__dropdown">
                    <div class="main-navi__item__dropdown__in">
                        <ul class="main-navi__item__dropdown__list">
                            <?/*foreach ($men["SECOND_LEVEL"] as $secmen):*/?>
                            <li class="main-navi__item__dropdown__item active">
                                <a href="<?/*=$secmen["LINK"]*/?>"><?/*=$secmen*/?></a>
                            </li>
                            <?/*endforeach;*/?>
                        </ul>
                    </div>
                </div>
            </li>-->
            <?if ($men["LINK"] == "/products_i_services/"):?>
                    <li class="main-navi__item arrow-i <?=(($men["LINK"]==$cur_page) || (CSite::InDir($men['LINK'])))?('active'):('')?>">
                        <a href="<?=$men["LINK"]?>"><?=$men["TEXT"]?></a>
                        <?if ($men["SECOND_LEVEL"]):?>
                            <div class="main-navi__item__dropdown big-size">
                            <div class="main-navi__item__dropdown__in">
                                <div class="row">
                                    <!--<div class="col-md-7">
                                        <ul class="main-navi__item__dropdown__list">
                                            <li class="main-navi__item__dropdown__item">
                                                <a href="#">Кровля</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Мягкая кровля</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Гибкая кровля</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Ондулин и шифер</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="main-navi__item__dropdown__item">
                                                <a href="#">Отделка</a>
                                            </li>
                                            <li class="main-navi__item__dropdown__item">
                                                <a href="#">Фундамент</a>
                                            </li>
                                            <li class="main-navi__item__dropdown__item">
                                                <a href="#">Окна</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Фото работ</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="main-navi__item__dropdown__item">
                                                <a href="#">Фасады</a>
                                            </li>
                                            <li class="main-navi__item__dropdown__item">
                                                <a href="#">Ремонт и реконструкция деревянных домов</a>
                                                <ul>
                                                    <li>
                                                        <a href="#">Фото работ</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>-->


                                    <div class="col-md-12">
                                        <ul class="main-navi__item__dropdown__list">
                                            <?foreach ($men["SECOND_LEVEL"] as $smp):?>
                                            <li class="main-navi__item__dropdown__item <?=(($smp["LINK"]==$cur_page) || (CSite::InDir($smp['LINK'])))?('active'):('')?>">
                                                <a href="<?=$smp["LINK"]?>"><?=$smp["TEXT"]?></a>
                                                <?if ($smp["THIRD_LEVEL"]):?>
                                                <ul>
                                                    <?foreach ($smp["THIRD_LEVEL"] as $tm):?>
                                                    <li>
                                                        <a href="<?=$tm["LINK"]?>"><?=$tm["TEXT"]?></a>
                                                    </li>
                                                    <?endforeach;?>
                                                </ul>
                                                <?endif;?>
                                            </li>
                                            <?endforeach;?>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?endif;?>
                    </li>
            <?else:?>
                    <li class="main-navi__item <?=($men["IS_PARENT"])?("arrow-i"):("")?> <?=(($men["LINK"]==$cur_page) || (CSite::InDir($men['LINK'])))?('active'):('')?>"">
                        <a href="<?=$men["LINK"]?>"><?=$men["TEXT"]?></a>
                        <?if ($men["SECOND_LEVEL"]):?>
                            <div class="main-navi__item__dropdown">
                                <div class="main-navi__item__dropdown__in">
                                    <ul class="main-navi__item__dropdown__list">
                                        <?foreach ($men["SECOND_LEVEL"] as $sm):?>
                                        <li class="main-navi__item__dropdown__item <?=(($sm["LINK"]==$cur_page) || (CSite::InDir($sm['LINK'])))?('active'):('')?>">
                                            <a href="<?=$sm["LINK"]?>"><?=$sm["TEXT"]?></a>
                                        </li>
                                        <?endforeach;?>
                                    </ul>
                                </div>
                            </div>
                        <?endif;?>
                    </li>
            <?endif;?>
            <?endforeach;?>
            <li class="main-navi__item more">
                <a class="parenter" href="#">Еще<i></i></a>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "menu_more", Array(
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
                    "ROOT_MENU_TYPE" => "more",	// Тип меню для первого уровня
                    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                ),
                    false
                );?>
            </li>
        </ul>
    </nav>
<?endif?>