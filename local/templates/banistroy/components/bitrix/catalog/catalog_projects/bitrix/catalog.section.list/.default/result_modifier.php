<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
foreach ($arResult["SECTIONS"] as $k=>$section){
    $sect = CIBlockSection::GetList([], ["IBLOCK_ID"=>$section["IBLOCK_ID"], "ID"=>$section["ID"]], false, ["ID", "UF_*"], false)->GetNext();
    $arResult["SECTIONS"][$k]["PROPERTIES"]["PRICE"] = $sect["~UF_PRICE"];
}
?>