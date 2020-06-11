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
<div class="global-table characteristics-p">
    <table>
        <thead>
        <tr>
            <th>Наименование материала</th>
            <th>Базовая цена</th>
            <th>Скидка( % )</th>
        </tr>
        </thead>
        <tbody>
        <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $discount = $arItem["PROPERTIES"]["DISCOUNT"]["VALUE"];
        $price = $arItem["PROPERTIES"]["BASE_PRICE"]["VALUE"];
        if (!$arItem["PROPERTIES"]["BASE_PRICE"]["VALUE"]){
            $price = "цена не указана";
        }
        if (!$arItem["PROPERTIES"]["DISCOUNT"]["VALUE"]){
            $discount = 0;
        }
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <td><?=$arItem["NAME"]?></td>
            <td><?=$price?></td>
            <td><?=$discount?> %</td>
        </tr>
        <?if ($arItem["SKU"]):?>
            <?foreach($arItem["SKU"] as $sku):?>
                <?
                $discount_sku = $sku["PROPERTIES"]["DISCOUNT"]["VALUE"];
                $price_sku = $sku["PROPERTIES"]["BASE_PRICE"]["VALUE"];
                if (!$sku["PROPERTIES"]["BASE_PRICE"]["VALUE"]){
                    $price_sku = "цена не указана";
                }
                if (!$sku["PROPERTIES"]["DISCOUNT"]["VALUE"]){
                    $discount_sku = 0;
                }
                $this->AddEditAction($sku['ID'], $sku['EDIT_LINK'], CIBlock::GetArrayByID($sku["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($sku['ID'], $sku['DELETE_LINK'], CIBlock::GetArrayByID($sku["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <td><?=$sku["NAME"]?></td>
                    <td><?=$price_sku?></td>
                    <td><?=$discount_sku?> %</td>
                </tr>
            <?endforeach;?>
        <?endif;?>
       <?endforeach;?>
        </tbody>
    </table>
</div>
<?else:?>
    <p>Раздел пуст!</p>
<?endif;?>