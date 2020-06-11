<?php
if ($arResult["ITEMS"]){
    foreach ($arResult["ITEMS"] as $k=>$arItem){
        $elems = CIBlockElement::GetList(["ID"=>"ASC"], ["IBLOCK_ID"=>SKU_IBLOCK_ID, "PROPERTY_LINK_TO_ELEMENT"=>$arItem["ID"]], false, false, ["ID", "NAME", "CODE", "PROPERTY_*"]);
        while ($el = $elems->GetNextElement()){
            $element = $el->GetFields();
            $element["PROPERTIES"] = $el->GetProperties();
            $arResult["ITEMS"][$k]["SKU"][] = $element;
        }
    }
}
