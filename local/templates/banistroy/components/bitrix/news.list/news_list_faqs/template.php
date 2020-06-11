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
    <div class="accordion" id="accordion">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="accordion__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="accordion__title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#<?=$arItem["ID"]?>">
                        <span class="accordion__title__text-b"><?=$arItem["NAME"]?></span>
                    </a>
                </div>
                <div id="<?=$arItem["ID"]?>" class="accordion__content collapse">
                    <div class="accordion__content__in">
                        <p><?=$arItem["~PREVIEW_TEXT"]?></p>
                    </div>
                </div>
            </div>
        <?endforeach;?>
    </div>
<?endif;?>

