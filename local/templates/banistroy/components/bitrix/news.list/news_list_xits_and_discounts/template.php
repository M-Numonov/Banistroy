<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<?if ($arResult["ITEMS"]):?>

<div class="slider product-slider">
      <?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div class="product-slider__item">

        <div class="product-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="product-item__photo">
                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                    <img src="<?= ZakHelper::iResize($arItem["PREVIEW_PICTURE"]["ID"], 240, 165, 1) ?>"
                         alt="photo"/>
                    <? if ($arItem["PROPERTIES"]["XIT"]["VALUE"]): ?>
                        <span class="product-item__sticker">Хит</span>
                    <? endif; ?>
                    <? if ($arItem["PROPERTIES"]["NEW"]["VALUE"]): ?>
                        <span class="product-item__sticker new">new</span>
                    <? endif; ?>
                    <? if ($arItem["PROPERTIES"]["LINK_TO_MATERIAL"]["VALUE"] && $arItem["PROPERTIES"]["LINK_TO_FUNDAMENT"]["VALUE"][0] && $arItem["PROPERTIES"]["LINK_TO_ROOFS"]["VALUE"][0]): ?>
                        <?
                        $discount = isDiscount($arItem["PROPERTIES"]["LINK_TO_MATERIAL"]["VALUE"][0], $arItem["PROPERTIES"]["LINK_TO_FUNDAMENT"]["VALUE"][0], $arItem["PROPERTIES"]["LINK_TO_ROOFS"]["VALUE"][0]);
                        ?>
                        <? if ($discount["IS_DISCOUNT"]): ?>
                            <? foreach ($discount["TEXT"] as $elem): ?>
                                <span class="product-item__sticker percent"><?= $elem ?></span>
                            <? endforeach; ?>
                        <? endif; ?>
                    <? endif; ?>
                </a>
            </div>
            <h3>
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?= TruncateText($arItem["NAME"], 50) ?></a>
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

    </div>
    <?endforeach;?>
</div>

<?endif;?>