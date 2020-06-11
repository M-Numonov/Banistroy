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
    <ul class="photogallery-list">
    <?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
        <li id="<?=$this->GetEditAreaId($arItem['ID']);?>" data-responsive="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?> 375, <?=$arItem["PREVIEW_PICTURE"]["SRC"]?> 480, <?=$arItem["PREVIEW_PICTURE"]["SRC"]?> 800" data-src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" data-sub-html="<span>Дом каркасный по индивидуальному проекту</span>">
            <div class="photogallery-list__item">
                <a href="#">
                    <span class="photogallery-list__photo">
                        <img src="<?=ZakHelper::iResize($arItem["PREVIEW_PICTURE"]["ID"], 240, 165, 1)?>" alt="photo"/>
                    </span>
                    <span class="photogallery-list__title"><?=TruncateText($arItem["NAME"], 30)?></span>
                </a>
            </div>
        </li>
    <?endforeach;?>
    </ul>
    <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
        <br /><?=$arResult["NAV_STRING"]?>
    <?endif;?>
<?else:?>
<p>Раздел пуст!</p>
<?endif;?>
