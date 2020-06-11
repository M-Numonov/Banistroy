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

    <section class="section">
        <div class="container">
            <h2 class="global-title">Статьи</h2>
            <div class="slider article-slider">
                <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="article-slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="article-item">
                            <div class="article-item__photo">
                                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                    <img src="<?=ZakHelper::iResize($arItem["PREVIEW_PICTURE"]["ID"], 85, 85, 1)?>" alt="photo" />
                                </a>
                            </div>
                            <div class="article-item__description">
                                <h3>
                                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=TruncateText($arItem["NAME"], 50)?></a>
                                </h3>
                                <p><?=TruncateText($arItem["PREVIEW_TEXT"], 70)?></p>
                            </div>
                        </div>
                    </div>
                <?
                endforeach;
                ?>
            </div>
            <div class="btn-panel indent-bt-none text-right">
                <a href="/articles/" class="btn-small">все статьи</a>
            </div>
        </div>
    </section>
<?endif;?>