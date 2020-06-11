<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$aMenuLinks = Array(
);
$cur_page = $APPLICATION->GetCurPage(false);
$section_id = 0;
$section = CIBlockSection::GetList(["ID"=>"DESC"], ["IBLOCK_ID"=>PS_IBLOCK_ID], false, ["ID", "NAME", "SECTION_PAGE_URL", "CODE", "DEPTH_LEVEL", "IBLOCK_SECTION_ID"], false);
while($sec = $section->GetNext()){
    if($cur_page ==$sec["SECTION_PAGE_URL"]){
        $section_id = $sec;
        break;
    }
}
$arFilter = [];
if ($section_id["DEPTH_LEVEL"]==1){
    $arFilter = [
        "IBLOCK_ID"=>PS_IBLOCK_ID,
        "SECTION_ID"=>$section_id["ID"]
    ];
}else{
    $arFilter = [
        "IBLOCK_ID"=>PS_IBLOCK_ID,
        "SECTION_ID"=>$section_id["IBLOCK_SECTION_ID"]
    ];
}
$sectn = CIBlockSection::GetList(["ID"=>"DESC"], $arFilter, false, ["ID", "NAME", "SECTION_PAGE_URL", "CODE", "DEPTH_LEVEL", "IBLOCK_SECTION_ID"], false);
while($sc = $sectn->GetNext()){
    if ($section_id["ID"] == $sc["ID"]){
        $arr = Array(
            $sc["NAME"],
            $sc["SECTION_PAGE_URL"],
            Array(),
            Array("SELECTED"=>true),
            ""
        );
    }else{
        $arr = Array(
            $sc["NAME"],
            $sc["SECTION_PAGE_URL"],
            Array(),
            Array(),
            ""
        );
    }

    $aMenuLinks[]  = $arr;
}

?>