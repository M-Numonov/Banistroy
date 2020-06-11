<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->setFrameMode(true);
?>
<form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get"
      class="smartfilter">
    <? foreach ($arResult["HIDDEN"] as $arItem): ?>
        <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
               value="<? echo $arItem["HTML_VALUE"] ?>"/>
    <? endforeach; ?>
    <!--names-->
    <div class="filter-panel__top-panel">
        <dl>
            <dt>Выбрать:</dt>
            <dd>
                <div class="filter-tabs__nav">
                    <ul>
                        <?
                        $count = 0;
                        foreach ($arResult["ITEMS"] as $key => $arItem) {
                            if (empty($arItem["VALUES"]) || isset($arItem["PRICE"]) || $arItem["CODE"]=="PRICE" || $arItem["CODE"]=="AREA") {
                                continue;
                            }


                            ?>
                            <li class="filter-tabs__nav__item <?= (!$count) ? ("active") : ("") ?>">
                                <a href="#t_<?= $arItem["ID"] ?>" data-toggle="tab"><?= $arItem["NAME"] ?></a>
                            </li>
                            <?
                            $count++;
                        } ?>
                        <li class="filter-tabs__nav__item">
                            <a href="/populyarnye-proekty/">Популярные</a>
                        </li>
                        <li class="filter-tabs__nav__item">
                            <div  class="bx-filter-popup-result <? if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"] ?>"
                                 id="modef" <? if (!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"'; ?> style="display: inline-block;">
                                <? echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">' . intval($arResult["ELEMENT_COUNT"]) . '</span>')); ?>
                                <span class="arrow"></span>
                                <a href="<? echo $arResult["FILTER_URL"] ?>" target=""></a>
                            </div>

                        </li>
                    </ul>
                </div>
            </dd>
        </dl>
    </div>

<!--    checkboxes -->

    <div class="filter-panel__md-panel">
        <div class="tab-content">

            <?
            //not prices
            $c = 0;
            foreach ($arResult["ITEMS"] as $key => $arItem) {
                if (
                    empty($arItem["VALUES"])
                    || isset($arItem["PRICE"])
                )
                    continue;

                if (
                    $arItem["DISPLAY_TYPE"] == "A"
                    && (
                        $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                    )
                )
                    continue;
                ?>

                <?
                $arCur = current($arItem["VALUES"]);
                switch ($arItem["DISPLAY_TYPE"]) {
                    case "A"://NUMBERS_WITH_SLIDER

                        break;


                    default://CHECKBOXES
                        ?>
                        <div class="tab-pane fade <?= (!$c) ? ("in active") : ("") ?>" id="t_<?= $arItem["ID"] ?>">
                            <ul>


                                <?
                                foreach ($arItem["VALUES"] as $val => $ar):?>
                                    <li>
                                        <div class="global-info-box">
                                            <input
                                                    type="checkbox"
                                                    value="<? echo $ar["HTML_VALUE"] ?>"
                                                    name="<? echo $ar["CONTROL_NAME"] ?>"
                                                    id="<? echo $ar["CONTROL_ID"] ?>"
                                                <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                    onclick="smartFilter.click(this)"
                                            />
                                            <label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                   class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled' : '' ?>"
                                                   for="<? echo $ar["CONTROL_ID"] ?>">


														<span class="global-info-box__text"
                                                              title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
                                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                                ?>&nbsp;(<span
                                                                    data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                            endif; ?></span>
                                            </label>
                                        </div>
                                    </li>
                                <? endforeach; ?>
                            </ul>
                        </div>

                    <?
                }
                ?>

                <?
                $c++;
            }
            ?>
        </div>
    </div>

    <!--    bottom button and price-->

    <div class="filter-panel__bottom-panel">

        <ul class="filter-panel__sliders">
        <?foreach($arResult["ITEMS"] as $key=>$arItem)//prices
        {
        $key = $arItem["ENCODED_ID"];
        if($arItem["CODE"]=="PRICE" || $arItem["CODE"]=="AREA"):
        if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
            continue;

        $step_num = 4;
        $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
        $prices = array();
        if (Bitrix\Main\Loader::includeModule("currency"))
        {
            for ($i = 0; $i < $step_num; $i++)
            {
                $prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
            }
            $prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
        }
        else
        {
            $precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
            for ($i = 0; $i < $step_num; $i++)
            {
                $prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $precision, ".", "");
            }
            $prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
        }
        ?>

            <?
            $min = $arItem["VALUES"]["MIN"]["VALUE"];
            $max = $arItem["VALUES"]["MAX"]["VALUE"];
            if ($arItem["VALUES"]["MIN"]["HTML_VALUE"])
                $min = $arItem["VALUES"]["MIN"]["HTML_VALUE"];
            if ($arItem["VALUES"]["MAX"]["HTML_VALUE"])
                $max = $arItem["VALUES"]["MAX"]["HTML_VALUE"];
            ?>

                <?if ($arItem["CODE"]=="PRICE"):?>

                <li>
                    <dl>
                        <dt>Цена, Р :</dt>
                        <dd>
                            <div class="filter-sliders">
                                <ul class="filter-sliders__list">
                                    <li>
                                        <div class="filter-sliders__field">
                                            <input type="text"
                                                   class="min-price"
                                                   name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                                   value="<?=$min?>"
                                                   onchange="smartFilter.keyup(this)"
                                                   id="first-price"
                                                   data-value="<?echo $arItem["VALUES"]["MIN"]["VALUE"]?>"
                                            />
                                        </div>
                                    </li>
                                    <li>
                                        <div class="filter-sliders__field">
                                            <input type="text"
                                                   class="max-price"
                                                   name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                                   value="<?=$max?>"
                                                   onchange="smartFilter.keyup(this)"
                                                   id="last-price"
                                                   data-value="<?echo $arItem["VALUES"]["MAX"]["VALUE"]?>"
                                            />
                                        </div>
                                    </li>
                                </ul>
                                <div id="slider-range"></div>
                            </div>
                        </dd>
                    </dl>
                </li>
                <?elseif($arItem["CODE"]=="AREA"):?>
                <li>
                    <dl>
                        <dt>Прощадь, м2 :</dt>
                        <dd>
                            <div class="filter-sliders">
                                <ul class="filter-sliders__list">
                                    <li>
                                        <div class="filter-sliders__field">
                                            <input class="min-price"
                                                   type="text"
                                                   name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                                   value="<?=$min?>"
                                                   size="5"
                                                   onkeyup="smartFilter.keyup(this)"
                                                   id="first-area"
                                                   data-value="<?=$arItem["VALUES"]["MIN"]["VALUE"]?>"
                                            />
                                        </div>
                                    </li>
                                    <li>
                                        <div class="filter-sliders__field">
                                            <input class="max-price"
                                                   type="text"
                                                   name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                                   value="<?=$max?>"
                                                   size="5"
                                                   onkeyup="smartFilter.keyup(this)"
                                                   id="last-area"
                                                   data-value="<?=$arItem["VALUES"]["MAX"]["VALUE"]?>"
                                            />
                                        </div>
                                    </li>
                                </ul>
                                <div id="slider-range2"></div>
                            </div>
                        </dd>
                    </dl>
                </li>
                <?endif;?>


        <?endif;
				}
				?>
        </ul>
        <ul class="filter-panel__btn-list">
            <li>
                <button type="submit" id="set_filter"
                        name="set_filter" class="dec-btn dark-bg big-size">
                    <span>Показать</span>
                </button>
            </li>
            <li>
                <button type="submit" id="del_filter"
                        name="del_filter" class="dec-btn big-size">
                    <span>Сбросить</span>
                </button>
            </li>
          </ul>

    </div>

</form>

<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>

<style>
    .bx-filter-popup-result{
        color: #146f68;
    }
</style>