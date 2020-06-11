<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arResult["SECTIONS"] = array_reverse( $arResult["SECTIONS"]);
$cp = $this->__component;
$section_ids = [];
foreach ($arResult["SECTIONS"] as $section){
    $section_ids[] = $section["ID"];
}
if (is_object($cp))
{
    $cp->arResult["SECTIONS_CUSTOM"] = $section_ids;
    $cp->SetResultCacheKeys(array("SECTIONS_CUSTOM", "SECTIONS")); //cache keys in $arResult array
}
$this->__component->SetResultCacheKeys(array("CACHED_TPL"));?>