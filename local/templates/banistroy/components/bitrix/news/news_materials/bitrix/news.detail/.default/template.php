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
<?if ($arResult["PREVIEW_PICTURE"]):?>
<div class="global-photo indent-bt">
    <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="photo" />
</div>
<?endif;?>
<div>
    <?=$arResult["~PREVIEW_TEXT"]?>
</div>