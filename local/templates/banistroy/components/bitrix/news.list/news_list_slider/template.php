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
<?if($arResult["ITEMS"]):?>
    <div class="slider promo-slider" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
        <div class="promo-slider__item" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>)">
            <div class="container">
                <div class="promo-slider__item__wrap">
                    <div class="promo-slider__item__wrap__in text-right">
                        <div class="promo-slider__content">
                            <h1 class="global-title"><?=$arItem["NAME"]?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?endforeach;?>
    </div>


<?endif;?>