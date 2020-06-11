<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$aMenuLinks = [];
$elems  = CIBlockElement::GetList(["SORT"=>"ASC"], ["IBLOCK_ID"=>MATERIALS_IBLOCK_ID, "SECTION_ID"=>LEFT_MENU_BUILDING_MATERIALS_SECTION_ID, "ACTIVE"=>"Y"], false, false, ["ID", "CODE", "NAME", "DETAIL_PAGE_URL"], ["nTopCount"=>5]);
while ($e = $elems->GetNext()){
    $arr = [
        $e["NAME"], $e["DETAIL_PAGE_URL"], [], [], ""
    ];
    $aMenuLinks[] = $arr;
}
?>