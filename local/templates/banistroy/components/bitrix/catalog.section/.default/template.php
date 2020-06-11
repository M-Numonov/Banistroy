<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */
$this->setFrameMode(true);

if ($arResult['ITEMS']):
    ?>

    <div id="pagination-ajax">
        <?
        if ($_REQUEST["m-ajax"]) {
            ob_end_flush();
            $APPLICATION->RestartBuffer();
            ob_start();
        }
        $shown = 0;
        $myArray = json_decode(json_encode($arResult["NAV_RESULT"]), true);

        if ($myArray["NavPageCount"] > $myArray["NavPageNomer"]) {
            $shown = $myArray["NavPageNomer"] * $myArray["NavPageSize"];
        } else {
            if ($myArray["NavPageCount"] == 1) {
                $shown = count($myArray["arResult"]);
            } else {
                $shown = ($myArray["NavPageNomer"] - 1) * $myArray["NavPageSize"] + count($myArray["arResult"]);
            }
        }

        $all_elemes = $myArray["NavRecordCount"];

        ?>
        <span class="projects-col__number">Отобрано <?= $shown ?> проектов из <?= $all_elemes ?></span>
        <? if ($_REQUEST["m-ajax"]) :?>
            <? $pagination = @ob_get_clean(); ?>
        <? endif; ?>
    </div>

    <ul class="projects-list" id="result-ajax">
        <? if ($_REQUEST["m-ajax"]):
            ob_end_flush();
            $APPLICATION->RestartBuffer();
            ob_start();
        endif; ?>
        <?
        foreach ($arResult['ITEMS'] as $arItem) {
            $uniqueId = $arItem['ID'] . '_' . md5($this->randString() . $component->getAction());
            $areaIds[$arItem['ID']] = $this->GetEditAreaId($uniqueId);
            $this->AddEditAction($uniqueId, $arItem['EDIT_LINK'], $elementEdit);
            $this->AddDeleteAction($uniqueId, $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams); ?>
            <li>
                <div class="product-item" id="<?= $this->GetEditAreaId($uniqueId); ?>">
                    <div class="product-item__photo">
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                            <img src="<?= ZakHelper::iResize($arItem["PREVIEW_PICTURE"]["ID"], 240, 165, 1) ?>"
                                 alt="photo"/>

                            <span class="product-item__sticker-list">
                                <? if ($arItem["PROPERTIES"]["XIT"]["VALUE"]): ?>
                                    <span class="product-item__sticker-list__item"> <span class="product-item__sticker">Хит</span></span>
                                <? endif; ?>
                                <? if ($arItem["PROPERTIES"]["NEW"]["VALUE"]): ?>
                                    <span class="product-item__sticker-list__item"> <span class="product-item__sticker new">new</span></span>
                                <? endif; ?>
                                <? if ($arItem["PROPERTIES"]["LINK_TO_MATERIAL"]["VALUE"] && $arItem["PROPERTIES"]["LINK_TO_FUNDAMENT"]["VALUE"][0] && $arItem["PROPERTIES"]["LINK_TO_ROOFS"]["VALUE"][0]): ?>
                                    <?
                                    $discount = isDiscount($arItem["PROPERTIES"]["LINK_TO_MATERIAL"]["VALUE"][0], $arItem["PROPERTIES"]["LINK_TO_FUNDAMENT"]["VALUE"][0], $arItem["PROPERTIES"]["LINK_TO_ROOFS"]["VALUE"][0]);
                                    ?>
                                    <? if ($discount["IS_DISCOUNT"]): ?>
                                        <? foreach ($discount["TEXT"] as $elem): ?>
                                            <span class="product-item__sticker-list__item"> <span class="product-item__sticker percent"><?= $elem ?></span> </span>
                                        <? endforeach; ?>
                                    <? endif; ?>
                                <? endif; ?>
                            </span>
                        </a>
                    </div>
                    <h3>
                        <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= TruncateText($arItem["NAME"], 50) ?></a>
                    </h3>
                    <p><?= TruncateText($arItem["PREVIEW_TEXT"], 200) ?></p>
                    <ul class="product-item__characteristics">
                        <? foreach ($arItem["DISPLAY_PROPERTIES"] as $dp): ?>
                            <li>
                                <? if (is_array($dp["DISPLAY_VALUE"])): ?>
                                    <span><?= $dp["NAME"] ?>: <strong><?= $dp["DISPLAY_VALUE"][0] ?></strong></span>
                                <? else: ?>
                                    <span><?= $dp["NAME"] ?>: <strong><?= $dp["VALUE"] ?></strong></span>
                                <? endif; ?>

                            </li>
                        <? endforeach; ?>
                    </ul>
                    <? if ($arItem["PROPERTIES"]["PRICE"]["VALUE"]): ?>
                        <ul class="product-item__price">
                            <li>
                                <?= $arItem["PROPERTIES"]["PRICE"]["VALUE"] ?>
                                <span class="rouble">
                                                    <xml version="1.0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1"
                                                         enable-background="new 0 0 512 512" viewBox="0 0 512 512"><g><path
                                                                    d="m288.134 319.2c88.291 0 159.6-71.458 159.6-159.6 0-88.004-71.596-159.6-159.6-159.6h-160.667c-8.284 0-15 6.716-15 15v209.933h-33.2c-8.284 0-15 6.716-15 15v64.267c0 8.284 6.716 15 15 15h33.2v34.267h-33.2c-8.284 0-15 6.716-15 15v64.267c0 8.284 6.716 15 15 15h33.2v49.266c0 8.284 6.716 15 15 15h64.267c8.284 0 15-6.716 15-15v-49.267h97.466c8.284 0 15-6.716 15-15v-64.267c0-8.284-6.716-15-15-15h-97.467v-34.266zm-81.401-224.933h81.4c36.024 0 65.333 29.309 65.333 65.333s-29.309 65.333-65.333 65.333h-81.4z"
                                                                    data-original="#000000" class="rouble-i"
                                                                    data-old_color="#000000"/></g> </svg>
                                                    </xml>
                                                </span>
                            </li>
                            <? if (getOldPrice($arItem["ID"])): ?>
                                <li>
                                                <span class="old-price">
                                                                <?= getOldPrice($arItem["ID"]); ?>
                                                    <span class="rouble">
                                                        <xml version="1.0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1"
                                                             enable-background="new 0 0 512 512" viewBox="0 0 512 512"><g><path
                                                                        d="m288.134 319.2c88.291 0 159.6-71.458 159.6-159.6 0-88.004-71.596-159.6-159.6-159.6h-160.667c-8.284 0-15 6.716-15 15v209.933h-33.2c-8.284 0-15 6.716-15 15v64.267c0 8.284 6.716 15 15 15h33.2v34.267h-33.2c-8.284 0-15 6.716-15 15v64.267c0 8.284 6.716 15 15 15h33.2v49.266c0 8.284 6.716 15 15 15h64.267c8.284 0 15-6.716 15-15v-49.267h97.466c8.284 0 15-6.716 15-15v-64.267c0-8.284-6.716-15-15-15h-97.467v-34.266zm-81.401-224.933h81.4c36.024 0 65.333 29.309 65.333 65.333s-29.309 65.333-65.333 65.333h-81.4z"
                                                                        data-original="#000000" class="rouble-i"
                                                                        data-old_color="#000000"/></g> </svg></xml>
                                                    </span>
                                                </span>
                                </li>
                            <? endif; ?>
                        </ul>
                    <? endif; ?>
                </div>
            </li>
        <? } ?>
        <? if ($_REQUEST["m-ajax"]): ?>
            <?
            $content = @ob_get_clean();
            ?>
        <? endif; ?>
    </ul>

    <div id="pagination-bottom">
    <? if ($arResult["NAV_RESULT"]->NavPageNomer != $arResult["NAV_RESULT"]->NavPageCount): ?>
    <? if ($arResult["ITEMS"]): ?>

            <? if ($_REQUEST["m-ajax"]):
                ob_end_flush();
                $APPLICATION->RestartBuffer();
                ob_start();
            endif; ?>
            <?
            $params = "";
            foreach ($_GET as $k => $param) {
                $key = explode("_", $k);
                if ($key[0] == "PAGEN" || $key[0] == "m-ajax") continue;
                $params = $params . "&" . $k . "=" . $param;
            }
            ?>
            <div class="text-center">
                <a href="javascript:void(0);" class="dec-btn btn-more" data-params="<?= $params ?>"
                   data-nav="<?= $arResult["NAV_RESULT"]->NavNum ?>"
                   data-page='<?= intval($arResult["NAV_RESULT"]->NavPageNomer) + 1 ?>'>
                    <span>Показать</span>
                </a>
            </div>
            <? if ($_REQUEST["m-ajax"]): ?>
                <?
                $more = @ob_get_clean();
                ?>
            <? endif; ?>

    <? endif; ?>

    <? endif; ?>
        <?
        if ($_REQUEST["m-ajax"] == "Y") {
            global $APPLICATION;
            $data = array(
                "CONTENT" => $content,
                "PAGINATION" => $pagination,
                "MORE" => $more
            );
            $data = json_encode($data);
            ob_get_flush();
            $APPLICATION->RestartBuffer();
            header('Content-Type: application/json');
            echo $data;
            die();
        }
        ?>
    </div>




<? else: ?>
    <p>Элементы не найдены!</p>
<? endif; ?>

