<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

/*$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();*/

if ($arResult["DETAIL_PICTURE"]["SRC"]){
    $arResult["MORE_PHOTO_CUSTOM"][] = $arResult["DETAIL_PICTURE"]["ID"];
}
if ($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]){
    foreach ($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $pic){
        $arResult["MORE_PHOTO_CUSTOM"][] = $pic;
    }
}
?>
<?foreach ($arResult["MORE_PHOTO_CUSTOM"] as $fi):?>
   <? $arResult["MORE_PHOTO_CUSTOM_SMALL"][]=ZakHelper::iResize($fi, 100, 50, 0)?>
<?endforeach;?>


<?
foreach ($arResult["PROPERTIES"] as $prop){
    if ($prop["CODE"]=="LINK_TO_MATERIAL" && $arResult["PROPERTIES"]["MATERIAL_CAPACITY"]["VALUE"]){
        $arResult["SKU"]["MATERIAL"] = $prop["VALUE"];
    }elseif ($prop["CODE"]=="LINK_TO_FUNDAMENT" && $arResult["PROPERTIES"]["FUNDAMENT_CAPACITY"]["VALUE"]){
        $arResult["SKU"]["FUNDAMENT"] = $prop["VALUE"];
    }elseif ($prop["CODE"]=="LINK_TO_ROOFS" && $arResult["PROPERTIES"]["ROOFS_CAPACITY"]["VALUE"]){
        $arResult["SKU"]["ROOF"] = $prop["VALUE"];
    }
}

$presents_list = [];
$discounts_list = [];
    if ($arResult["SKU"]["MATERIAL"]) {
        $mats = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $arResult["SKU"]["MATERIAL"]], false, false, ["ID", "NAME", "IBLOCK_ID"]);
        while ($m = $mats->GetNextElement()) {
            $ma = $m->GetFields();
            $ma["PROPS"] = $m->GetProperties();
            $tps = CIBlockElement::GetList([], ["IBLOCK_ID" => SKU_IBLOCK_ID, "PROPERTY_LINK_TO_ELEMENT" => $ma["ID"]], false, false, ["ID", "NAME", "IBLOCK_ID"]);
            $ttps = [];
            while ($tp = $tps->GetNextElement()) {
                $ta = $tp->GetFields();
                $ta["PROPS"] = $tp->GetProperties();

                $is_discount = ($ta["PROPS"]["DISCOUNT"]["VALUE"] > 0 && $ta["PROPS"]["DISCOUNT"]["VALUE"] < 100)?(1):(0);
                $is_present = ($ta["PROPS"]["DISCOUNT"]["VALUE"] == 100 && $ta["PROPS"]["BASE_PRICE"]["VALUE"] != 1)?(1):(0);
                if ($is_present){
                    $present = $ma["NAME"]." размер ".$t["NAME"]." в подарок";
                    $arResult["SKU"]["PRESENT_LIST"][] = $present;
                }
                if ($is_discount){
                    $dis = $ma["NAME"]." размер ".$ta["NAME"]."  с скидкой ".$ta["PROPS"]["DISCOUNT"]["VALUE"]."%";
                    $arResult["SKU"]["DISCOUNTS_LIST"][] = $dis;
                    $price = $arResult["PROPERTIES"]["MATERIAL_CAPACITY"]["VALUE"] * $ta["PROPS"]["BASE_PRICE"]["VALUE"] - $arResult["PROPERTIES"]["MATERIAL_CAPACITY"]["VALUE"] * $ta["PROPS"]["BASE_PRICE"]["VALUE"] * $ta["PROPS"]["DISCOUNT"]["VALUE"]/100;
                }else{
                    if ($is_present){
                        $price = 0;
                    }else {
                        $price = $arResult["PROPERTIES"]["MATERIAL_CAPACITY"]["VALUE"] * $ta["PROPS"]["BASE_PRICE"]["VALUE"];
                    }
                }
                $t = ["ID" => $ta["ID"], "NAME" => $ta["NAME"], "OLD_PRICE" => $ta["PROPS"]["BASE_PRICE"]["VALUE"] * $arResult["PROPERTIES"]["MATERIAL_CAPACITY"]["VALUE"], "PRICE" => $price, "IS_DISCOUNT"=>$is_discount, "IS_PRESENT"=>$is_present];
                if ($ta["PROPS"]["BASE_PRICE"]["VALUE"]){
                    $ttps[] = $t;
                }
            }

            $is_discount = ($ma["PROPS"]["DISCOUNT"]["VALUE"] > 0 && $ma["PROPS"]["DISCOUNT"]["VALUE"] < 100)?(1):(0);
            $is_present = ($ma["PROPS"]["DISCOUNT"]["VALUE"] == 100 && $ma["PROPS"]["BASE_PRICE"]["VALUE"] != 1)?(1):(0);

            if ($is_present){
                $present = $ma["NAME"]." в подарок";
                $arResult["SKU"]["PRESENT_LIST"][] = $present;
            }

            if ($is_discount){
                $dis = $ma["NAME"]." с скидкой ".$ma["PROPS"]["DISCOUNT"]["VALUE"]."%";
                $arResult["SKU"]["DISCOUNTS_LIST"][] = $dis;
                $price = $arResult["PROPERTIES"]["MATERIAL_CAPACITY"]["VALUE"] * $ma["PROPS"]["BASE_PRICE"]["VALUE"] - $arResult["PROPERTIES"]["MATERIAL_CAPACITY"]["VALUE"] * $ma["PROPS"]["BASE_PRICE"]["VALUE"] * $ma["PROPS"]["DISCOUNT"]["VALUE"]/100;
            }else{
                if ($is_present){
                    $price = 0;
                }else {
                    $price = $arResult["PROPERTIES"]["MATERIAL_CAPACITY"]["VALUE"] * $ma["PROPS"]["BASE_PRICE"]["VALUE"];
                }
            }
            $mat = ["ID" => $ma["ID"], "NAME" => $ma["NAME"], "OLD_PRICE" => $ma["PROPS"]["BASE_PRICE"]["VALUE"] * $arResult["PROPERTIES"]["MATERIAL_CAPACITY"]["VALUE"], "PRICE" => $price, "IS_DISCOUNT"=>$is_discount, "IS_PRESENT"=>$is_present, "OFFERS"=>$ttps];

            if ($ma["PROPS"]["BASE_PRICE"]["VALUE"] && $mat["OFFERS"]) {
                $arResult["SKU"]["MATERIALS"][] = $mat;
            }
        }
    }
    unset($arResult["SKU"]["MATERIAL"]);


    if ($arResult["SKU"]["FUNDAMENT"]) {
        $fats = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $arResult["SKU"]["FUNDAMENT"]], false, false, ["ID", "NAME", "IBLOCK_ID"]);
        while ($f = $fats->GetNextElement()) {
            $fa = $f->GetFields();
            $fa["PROPS"] = $f->GetProperties();

            $is_discount = ($fa["PROPS"]["DISCOUNT"]["VALUE"] > 0 && $fa["PROPS"]["DISCOUNT"]["VALUE"] < 100)?(1):(0);
            $is_present = ($fa["PROPS"]["DISCOUNT"]["VALUE"] == 100 && $fa["PROPS"]["BASE_PRICE"]["VALUE"] != 1)?(1):(0);
            if ($is_present){
                $present = $fa["NAME"]." в подарок";
                $arResult["SKU"]["PRESENT_LIST"][] = $present;
            }
            if ($is_discount){
                $dis = $fa["NAME"]." с скидкой ".$fa["PROPS"]["DISCOUNT"]["VALUE"]."%";
                $arResult["SKU"]["DISCOUNTS_LIST"][] = $dis;

                $price = ($arResult["PROPERTIES"]["FUNDAMENT_CAPACITY"]["VALUE"] * $fa["PROPS"]["BASE_PRICE"]["VALUE"]) - ($arResult["PROPERTIES"]["FUNDAMENT_CAPACITY"]["VALUE"] * $fa["PROPS"]["BASE_PRICE"]["VALUE"] * $fa["PROPS"]["DISCOUNT"]["VALUE"]/100);
            }else{
                if ($is_present){
                    $price = 0;
                }else{
                    $price = $arResult["PROPERTIES"]["FUNDAMENT_CAPACITY"]["VALUE"] * $fa["PROPS"]["BASE_PRICE"]["VALUE"];
                }

            }
            $fat = ["ID" => $fa["ID"], "NAME" => $fa["NAME"], "OLD_PRICE" => $fa["PROPS"]["BASE_PRICE"]["VALUE"] * $arResult["PROPERTIES"]["FUNDAMENT_CAPACITY"]["VALUE"], "PRICE" => $price, "IS_DISCOUNT"=>$is_discount, "IS_PRESENT"=>$is_present];


            if ($fa["PROPS"]["BASE_PRICE"]["VALUE"]) {
                $arResult["SKU"]["FUNDAMENTS"][] = $fat;
            }
        }
    }
    unset($arResult["SKU"]["FUNDAMENT"]);


    if ($arResult["SKU"]["ROOF"]) {
        $rats = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $arResult["SKU"]["ROOF"]], false, false, ["ID", "NAME", "IBLOCK_ID"]);
        while ($r = $rats->GetNextElement()) {
            $ra = $r->GetFields();
            $ra["PROPS"] = $r->GetProperties();

            $is_discount = ($ra["PROPS"]["DISCOUNT"]["VALUE"] > 0 && $ra["PROPS"]["DISCOUNT"]["VALUE"] < 100)?(1):(0);
            $is_present = ($ra["PROPS"]["DISCOUNT"]["VALUE"] == 100 && $ra["PROPS"]["BASE_PRICE"]["VALUE"] != 1)?(1):(0);
            if ($is_present){
                $present = $ra["NAME"]." в подарок";
                $arResult["SKU"]["PRESENT_LIST"][] = $present;
            }
            if ($is_discount){
                $dis = $ra["NAME"]." с скидкой ".$ra["PROPS"]["DISCOUNT"]["VALUE"]."%";
                $arResult["SKU"]["DISCOUNTS_LIST"][] = $dis;

                $price = $arResult["PROPERTIES"]["ROOFS_CAPACITY"]["VALUE"] * $ra["PROPS"]["BASE_PRICE"]["VALUE"] - $arResult["PROPERTIES"]["ROOFS_CAPACITY"]["VALUE"] * $ra["PROPS"]["BASE_PRICE"]["VALUE"] * $ra["PROPS"]["DISCOUNT"]["VALUE"]/100;
            }else{
                if ($is_present){
                    $price = 0;
                }else {
                    $price = $arResult["PROPERTIES"]["ROOFS_CAPACITY"]["VALUE"] * $ra["PROPS"]["BASE_PRICE"]["VALUE"];
                }
            }
            $rat = ["ID" => $ra["ID"], "NAME" => $ra["NAME"], "OLD_PRICE" => $ra["PROPS"]["BASE_PRICE"]["VALUE"] * $arResult["PROPERTIES"]["ROOFS_CAPACITY"]["VALUE"], "PRICE" => $price, "IS_DISCOUNT"=>$is_discount, "IS_PRESENT"=>$is_present];

            if ($ra["PROPS"]["BASE_PRICE"]["VALUE"]) {
                $arResult["SKU"]["ROOFS"][] = $rat;
            }
        }
    }
    unset($arResult["SKU"]["ROOF"]);

    echo "<pre>";
    print_r($arResult["SKU"]);
    echo "</pre>";
    ?>