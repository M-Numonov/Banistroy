<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$aMenuLinks = [];
$elems  = CIBlockElement::GetList(["SORT"=>"ASC"], ["IBLOCK_ID"=>MATERIALS_IBLOCK_ID, "ACTIVE"=>"Y", "IBLOCK_SECTION_ID"=>MATERIALS_SECTION_ID], false, false, ["ID", "CODE", "NAME", "DETAIL_PAGE_URL"]);
while ($e = $elems->GetNext()){
    $arr = [
        $e["NAME"], $e["DETAIL_PAGE_URL"], [], [], ""
    ];
    $aMenuLinks[] = $arr;
}
?>