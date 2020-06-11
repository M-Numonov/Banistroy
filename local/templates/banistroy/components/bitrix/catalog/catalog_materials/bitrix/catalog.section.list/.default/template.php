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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
?>
<? if ($arResult["SECTIONS"]): ?>
    <ul class="project-list">
        <? foreach ($arResult['SECTIONS'] as &$arSection): ?>
            <? $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
            ?>
            <li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                <div class="project-list__item-materials">
                    <a href="<?= $arSection["SECTION_PAGE_URL"] ?>">
                        <div class="project-list__info">
                            <h3 class="global-title"><?= $arSection["NAME"] ?></h3>
                            <span href="<?= $arSection["SECTION_PAGE_URL"] ?>"
                                  class="project-list__info__more">более подробнее</span>
                        </div>
                    </a>
                </div>
            </li>
        <? endforeach; ?>
    </ul>
    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <br/><?= $arResult["NAV_STRING"] ?>
    <? endif; ?>
<? else: ?>
    <p>Раздел пуст!</p>
<? endif; ?>