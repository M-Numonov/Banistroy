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

    <section class="section indent-none">
        <div class="slider photo-slider">
        <?foreach($arResult["ITEMS"] as $arElement):?>
            <div class="photo-slider__item" style="background-image: url(<?=$arElement['PREVIEW_PICTURE']['SRC']?>")></div>
        <?endforeach;?>
        </div>
        <div class="info-slider-wrap">
            <div class="container">
                <div class="slider info-slider">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
                    <div class="info-slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="info-slider__item__content">
                            <h2 class="global-title"><?=$arItem["NAME"]?></h2>
                           <p> <?=$arItem["~PREVIEW_TEXT"]?></p>
                        </div>
                    </div>
                    <?endforeach;?>
                </div>
            </div>
        </div>
    </section>

<?endif;?>