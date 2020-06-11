<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$sections = [];
$secs = CIBlockSection::GetList(["sort"=>"ASC"], ["IBLOCK_ID"=>PS_IBLOCK_ID, "SECTION_ID"=>LEFT_MENU_BUILDING_BAN_SECTION_ID, "ACTIVE"=>"Y"], false, ["ID", "CODE", "NAME", "SECTION_PAGE_URL"], ["nTopCount"=>5]);
while($sec = $secs->GetNext()){
    $sections[] = $sec;
}
$aMenuLinks = [];
foreach ($sections as $s){
    $ar = [
        $s["NAME"], $s["SECTION_PAGE_URL"], [], [], ""
    ];
    $aMenuLinks[] = $ar;
}
?>