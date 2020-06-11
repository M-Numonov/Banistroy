<?php
$aMenu = [];
$first_level = [];
$second_count = 0;
$third_count = 0;
$custom_menus = [];
$custom_ms = CIBlockSection::GetList(["ID"=>"ASC"], ["IBLOCK_ID"=>PROJECTS_IBLOCK_ID, "ID"=>CUSTOM_SECTIONS], false, ["*"], false);
while($sm = $custom_ms->GetNext()){
    $s = array(
        "TEXT" => $sm["NAME"],
        "LINK" => $sm["SECTION_PAGE_URL"],
        "SELECTED" => "",
        "PERMISSION" => "X",
        "ADDITIONAL_LINKS" => Array
        (),

        "ITEM_TYPE" => "D",
        "ITEM_INDEX" => "0",
        "PARAMS" => Array
        (),

        "CHAIN" => Array
        (
            0 => "Проекты домов"
        ),
        "DEPTH_LEVEL" => $sm["DEPTH_LEVEL"],
        "IS_PARENT" => "",
    );
    $custom_menus[] = $s;
}
$counter = 0;
foreach ($arResult as $menu){
    $counter++;
    if ($menu["DEPTH_LEVEL"] == 1){
        if ($first_level){
            $aMenu[] = $first_level;
        }
        $second_count = 0;
        $third_count = 0;
        $first_level = $menu;
        if ($menu["LINK"]=="/proekti/doma/"){
            $first_level["IS_PARENT"]=1;
            $first_level["SECOND_LEVEL"] = $custom_menus;
        }
        if ($counter == count($arResult)){
            if ($first_level){
                $aMenu[] = $first_level;
            }
        }
    }elseif ($menu["DEPTH_LEVEL"] == 2){
        $second_count++;
        $first_level["SECOND_LEVEL"][$second_count] = $menu;
    }elseif ($menu["DEPTH_LEVEL"] == 3){
       $third_count++;
        $first_level["SECOND_LEVEL"][$second_count]["THIRD_LEVEL"][$third_count] = $menu;
    } elseif ($menu["DEPTH_LEVEL"] == 4){
        $first_level["SECOND_LEVEL"][$second_count]["THIRD_LEVEL"][$third_count]["FOURTH_LEVEL"][] = $menu;
    }
}
$arResult["MENU"] = $aMenu;