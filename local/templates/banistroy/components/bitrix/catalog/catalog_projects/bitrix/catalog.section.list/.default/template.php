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

if ($arResult['SECTIONS']):

    $strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
    $strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
    $arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

    $this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

    ?>
    <ul class="project-list">
        <?
        foreach ($arResult['SECTIONS'] as &$arSection) :?>
            <?
            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
            ?>
            <li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
                <div class="project-list__item" style="background-image: url(<?=ZakHelper::iResize($arSection["PICTURE"]["ID"], 545, 545, 1)?>)">
                    <div onclick="window.location.href='<?=$arSection["SECTION_PAGE_URL"]?>'" class="project-list__info">
                        <h3 class="global-title"><?=$arSection["NAME"]?></h3>
                        <div class="project-list__info__in">
                            <p>
                                <?=$arSection["DESCRIPTION"]?>
                            </p>
                            <?if ($arSection["PROPERTIES"]["PRICE"]):?>
                            <span class="project-list__price">
                                            <?=$arSection["PROPERTIES"]["PRICE"]?>
                                            <span class="rouble">
                                                <xml version = "1.0">
                                                <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1"
                                                     enable-background="new 0 0 512 512" viewBox="0 0 512 512"><g><path
                                                                d="m288.134 319.2c88.291 0 159.6-71.458 159.6-159.6 0-88.004-71.596-159.6-159.6-159.6h-160.667c-8.284 0-15 6.716-15 15v209.933h-33.2c-8.284 0-15 6.716-15 15v64.267c0 8.284 6.716 15 15 15h33.2v34.267h-33.2c-8.284 0-15 6.716-15 15v64.267c0 8.284 6.716 15 15 15h33.2v49.266c0 8.284 6.716 15 15 15h64.267c8.284 0 15-6.716 15-15v-49.267h97.466c8.284 0 15-6.716 15-15v-64.267c0-8.284-6.716-15-15-15h-97.467v-34.266zm-81.401-224.933h81.4c36.024 0 65.333 29.309 65.333 65.333s-29.309 65.333-65.333 65.333h-81.4z"
                                                                data-original="#000000" class="rouble-i"
                                                                data-old_color="#000000"/></g> </svg></xml>
                                            </span>
                                        </span>
                            <?endif;?>
                        </div>
                        <span onclick="window.location.href='<?=$arSection["SECTION_PAGE_URL"]?>'" class="project-list__info__more_custom">более подробнее</span>
                    </div>
                </div>
            </li>

        <? endforeach; ?>
    </ul>

<? endif; ?>