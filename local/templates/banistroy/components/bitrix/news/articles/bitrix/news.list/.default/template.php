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

<?
if ($arResult["ITEMS"]):
?>
    <ul class="articles-list">
        <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li>
            <div class="article-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="article-item__photo">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" tabindex="0">
                        <img src="<?=ZakHelper::iResize($arItem["PREVIEW_PICTURE"]["ID"], 85, 85, 1)?>" alt="photo">
                    </a>
                </div>
                <div class="article-item__description">
                    <h3>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" tabindex="0"><?=$arItem["NAME"]?></a>
                    </h3>
                    <p><?=TruncateText($arItem["PREVIEW_TEXT"], 200)?></p>
                </div>
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
