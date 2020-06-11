<?
function _Check404Error()
{
    if (defined('ERROR_404') && ERROR_404 == 'Y' || CHTTP::GetLastStatus() == "404 Not Found") {
        GLOBAL $APPLICATION;
        $APPLICATION->RestartBuffer();
        require $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/header.php';
        require $_SERVER['DOCUMENT_ROOT'] . '/404.php';
        require $_SERVER['DOCUMENT_ROOT'] . SITE_TEMPLATE_PATH . '/footer.php';
    }
}

function isDiscount($material, $fundament, $roof)
{

    $mat = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $material], false, false, ["ID", "NAME", "PROPERTY_DISCOUNT"]);
    $matel = [];
    while ($m = $mat->GetNextElement()) {
        $matel = $m->GetFields();
    }

    $fun = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $fundament], false, false, ["ID", "NAME", "PROPERTY_DISCOUNT"]);
    $fundam = [];
    while ($f = $fun->GetNextElement()) {
        $fundam = $f->GetFields();
    }

    $rf = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $roof], false, false, ["ID", "NAME", "PROPERTY_DISCOUNT"]);
    $roofs = [];
    while ($r = $rf->GetNextElement()) {
        $roofs = $r->GetFields();
    }

    $result = [];
    if ($matel["PROPERTY_DISCOUNT_VALUE"]) {
        $result["TEXT"]["MATERIAL"] = $matel["PROPERTY_DISCOUNT_VALUE"] . "% на материал";
    }
    if ($fundam["PROPERTY_DISCOUNT_VALUE"]) {
        $result["TEXT"]["FUNDAMENT"] = $fundam["PROPERTY_DISCOUNT_VALUE"] . "% на фундамент";
    }
    if ($roofs["PROPERTY_DISCOUNT_VALUE"]) {
        $result["TEXT"]["ROOF"] = $roofs["PROPERTY_DISCOUNT_VALUE"] . "% на кровля";
    }

    if (count($result) > 0) {
        $result["IS_DISCOUNT"] = true;
    }
    return $result;
}

function getOldPrice($pid)
{

    $project = CIBlockElement::GetList([], ["IBLOCK_ID" => PROJECTS_IBLOCK_ID, "ID" => $pid], false, false, ["ID", "NAME", "PROPERTY_LINK_TO_MATERIAL", "PROPERTY_LINK_TO_FUNDAMENT", "PROPERTY_LINK_TO_ROOFS", "PROPERTY_MATERIAL_CAPACITY", "PROPERTY_FUNDAMENT_CAPACITY", "PROPERTY_ROOFS_CAPACITY", "PROPERTY_PRICE"])->GetNext();

    $mat = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $project["PROPERTY_LINK_TO_MATERIAL_VALUE"]], false, false, ["ID", "NAME", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
    $matel = [];
    while ($m = $mat->GetNextElement()) {
        $matel = $m->GetFields();
    }

    $fun = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $project["PROPERTY_LINK_TO_FUNDAMENT_VALUE"]], false, false, ["ID", "NAME", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
    $fundam = [];
    while ($f = $fun->GetNextElement()) {
        $fundam = $f->GetFields();
    }

    $rf = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $project["PROPERTY_LINK_TO_ROOFS_VALUE"]], false, false, ["ID", "NAME", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
    $roofs = [];
    while ($r = $rf->GetNextElement()) {
        $roofs = $r->GetFields();
    }

    $prices = 0;

    $price = $project["PROPERTY_PRICE_VALUE"];

    $matprice = $project["PROPERTY_MATERIAL_CAPACITY_VALUE"] * $matel["PROPERTY_BASE_PRICE_VALUE"];
    $fundprice = $project["PROPERTY_FUNDAMENT_CAPACITY_VALUE"] * $fundam["PROPERTY_BASE_PRICE_VALUE"];
    $roofprice = $project["PROPERTY_ROOFS_CAPACITY_VALUE"] * $roofs["PROPERTY_BASE_PRICE_VALUE"];

    $oldprice = $matprice + $fundprice + $roofprice;

    if ($oldprice > $price) {
        $prices = $oldprice;
    }
    return $prices;
}

function updatePriceAndDiscountOnChange(&$arFields)
{
    if ($arFields["IBLOCK_ID"] == MATERIALS_IBLOCK_ID) {

        CModule::IncludeModule("iblock");
        $mater = CIBlockElement::GetList([], ["IBLOCK_ID" => $arFields["IBLOCK_ID"], "ID" => $arFields["ID"]], false, false, ["ID", "NAME", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"])->GetNextElement();
        $material = $mater->GetFields();
        $properties = [];
        $counter = 0;
        foreach ($arFields["PROPERTY_VALUES"] as $id) {
            if (!$counter) {
                foreach ($id as $code) {
                    $properties["PRICE"] = $code["VALUE"];
                }
            } else {
                foreach ($id as $code) {
                    $properties["DISCOUNT"] = $code["VALUE"];
                }
            }
            $counter++;
            if ($counter>1) break;
        }

        if ($material["PROPERTY_BASE_PRICE_VALUE"] != $properties["PRICE"] || $material["PROPERTY_DISCOUNT_VALUE"] != $properties["DISCOUNT"]) {


            $elements = CIBlockElement::GetList([],
                ["IBLOCK_ID" => PROJECTS_IBLOCK_ID,
                    array(
                        "LOGIC" => "OR",
                        array("PROPERTY_LINK_TO_MATERIAL" => $arFields["ID"]),
                        array("PROPERTY_LINK_TO_FUNDAMENT" => $arFields["ID"]),
                        array("PROPERTY_LINK_TO_ROOFS" => $arFields["ID"]),
                    ),
                ], false, false, ["ID", "NAME", "IBLOCK_ID"]);
            while ($e = $elements->GetNextElement()) {
                $PROP = array();
                $PROP["DISCOUNT"] = 0;
                $el = $e->GetFields();
                $el["PROPS"] = $e->GetProperties();
                $dsc = $material["PROPERTY_DISCOUNT_VALUE"] + $properties["DISCOUNT"];
                if ($dsc > 0) {
                    $PROP["DISCOUNT"] = 1;
                }

                    if ($properties["PRICE"] != $material["PROPERTY_BASE_PRICE_VALUE"]) {
                    $props = [];
                    $current_prop = 0;
                    $price = 0;


                    if ($arFields["IBLOCK_SECTION"][0] == MATERIALS_SECTION) {

                        if ($material["ID"] != $el["PROPS"]["LINK_TO_MATERIAL"]["VALUE"][0]){
                            continue;
                        }

                        $disc = ($properties["DISCOUNT"]) ? ($properties["DISCOUNT"]) : ($material["PROPERTY_DISCOUNT_VALUE"]);
                        if ($disc) {
                            $PROP["DISCOUNT"] = 1;
                            $m_price = ($el["PROPS"]["MATERIAL_CAPACITY"]["VALUE"] * $properties["PRICE"]) - ($el["PROPS"]["MATERIAL_CAPACITY"]["VALUE"] * $properties["PRICE"] * $disc / 100);
                        } else {
                            $m_price = ($el["PROPS"]["MATERIAL_CAPACITY"]["VALUE"] * $properties["PRICE"]);
                        }


                        $fun = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $el["PROPS"]["LINK_TO_FUNDAMENT"]["VALUE"][0]], false, false, ["ID", "NAME", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
                        $fundam = [];
                        while ($f = $fun->GetNextElement()) {
                            $fundam = $f->GetFields();
                        }

                        if ($fundam["PROPERTY_DISCOUNT_VALUE"]) {
                            $PROP["DISCOUNT"] = 1;
                            $f_price = ($el["PROPS"]["FUNDAMENT_CAPACITY"]["VALUE"] * $fundam["PROPERTY_BASE_PRICE_VALUE"]) - ($el["PROPS"]["FUNDAMENT_CAPACITY"]["VALUE"] * $fundam["PROPERTY_BASE_PRICE_VALUE"] * $fundam["PROPERTY_DISCOUNT_VALUE"] / 100);
                        } else {
                            $f_price = ($el["PROPS"]["FUNDAMENT_CAPACITY"]["VALUE"] * $fundam["PROPERTY_BASE_PRICE_VALUE"]);
                        }


                        $rf = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $el["PROPS"]["LINK_TO_ROOFS"]["VALUE"][0]], false, false, ["ID", "NAME", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
                        $roofs = [];
                        while ($r = $rf->GetNextElement()) {
                            $roofs = $r->GetFields();
                        }

                        if ($roofs["PROPERTY_DISCOUNT_VALUE"]) {
                            $PROP["DISCOUNT"] = 1;
                            $r_price = ($el["PROPS"]["ROOFS_CAPACITY"]["VALUE"] * $roofs["PROPERTY_BASE_PRICE_VALUE"]) - ($el["PROPS"]["ROOFS_CAPACITY"]["VALUE"] * $roofs["PROPERTY_BASE_PRICE_VALUE"] * $roofs["PROPERTY_DISCOUNT_VALUE"] / 100);
                        } else {
                            $r_price = ($el["PROPS"]["ROOFS_CAPACITY"]["VALUE"] * $roofs["PROPERTY_BASE_PRICE_VALUE"]);
                        }

                        $price = $m_price + $f_price + $r_price;

                    } elseif ($arFields["IBLOCK_SECTION"][0] == FUNDAMENT_SECTION) {


                        if ($material["ID"] != $el["PROPS"]["LINK_TO_FUNDAMENT"]["VALUE"][0]){
                            continue;
                        }

                        $disc = ($properties["DISCOUNT"]) ? ($properties["DISCOUNT"]) : ($material["PROPERTY_DISCOUNT_VALUE"]);
                        if ($disc) {
                            $PROP["DISCOUNT"] = 1;
                            $f_price = ($el["PROPS"]["FUNDAMENT_CAPACITY"]["VALUE"] * $properties["PRICE"]) - ($el["PROPS"]["FUNDAMENT_CAPACITY"]["VALUE"] * $properties["PRICE"] * $disc / 100);
                        } else {
                            $f_price = ($el["PROPS"]["FUNDAMENT_CAPACITY"]["VALUE"] * $properties["PRICE"]);
                        }


                        $mate = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" =>$el["PROPS"]["LINK_TO_MATERIAL"]["VALUE"][0]], false, false, ["ID", "NAME", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
                        $mates = [];
                        while ($m = $mate->GetNextElement()) {
                            $mates = $m->GetFields();
                        }

                        if ($mates["PROPERTY_DISCOUNT_VALUE"]) {
                            $PROP["DISCOUNT"] = 1;
                            $m_price = ($el["PROPS"]["MATERIAL_CAPACITY"]["VALUE"] * $mates["PROPERTY_BASE_PRICE_VALUE"]) - ($el["PROPS"]["MATERIAL_CAPACITY"]["VALUE"] * $mates["PROPERTY_BASE_PRICE_VALUE"] * $mates["PROPERTY_DISCOUNT_VALUE"] / 100);
                        } else {
                            $m_price = ($el["PROPS"]["MATERIAL_CAPACITY"]["VALUE"] * $mates["PROPERTY_BASE_PRICE_VALUE"]);
                        }

                        $rf = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $el["PROPS"]["LINK_TO_ROOFS"]["VALUE"][0]], false, false, ["ID", "NAME", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
                        $roofs = [];
                        while ($r = $rf->GetNextElement()) {
                            $roofs = $r->GetFields();
                        }

                        if ($roofs["PROPERTY_DISCOUNT_VALUE"]) {
                            $PROP["DISCOUNT"] = 1;
                            $r_price = ($el["PROPS"]["ROOFS_CAPACITY"]["VALUE"] * $roofs["PROPERTY_BASE_PRICE_VALUE"]) - ($el["PROPS"]["ROOFS_CAPACITY"]["VALUE"] * $roofs["PROPERTY_BASE_PRICE_VALUE"] * $roofs["PROPERTY_DISCOUNT_VALUE"] / 100);
                        } else {
                            $r_price = ($el["PROPS"]["ROOFS_CAPACITY"]["VALUE"] * $roofs["PROPERTY_BASE_PRICE_VALUE"]);
                        }

                        $price = $m_price + $f_price + $r_price;


                    } elseif ($arFields["IBLOCK_SECTION"][0] == ROOFS_SECTION) {


                        if ($material["ID"] != $el["PROPS"]["LINK_TO_ROOFS"]["VALUE"][0]){
                          continue;
                        }

                        $disc = ($properties["DISCOUNT"]) ? ($properties["DISCOUNT"]) : ($material["PROPERTY_DISCOUNT_VALUE"]);
                        if ($disc) {
                            $PROP["DISCOUNT"] = 1;
                            $r_price = ($el["PROPS"]["ROOFS_CAPACITY"]["VALUE"] * $properties["PRICE"]) - ($el["PROPS"]["ROOFS_CAPACITY"]["VALUE"] * $properties["PRICE"] * $disc / 100);
                        } else {
                            $r_price = ($el["PROPS"]["ROOFS_CAPACITY"]["VALUE"] * $properties["PRICE"]);
                        }


                        $mate = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" =>$el["PROPS"]["LINK_TO_MATERIAL"]["VALUE"][0]], false, false, ["ID", "NAME", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
                        $mates = [];
                        while ($m = $mate->GetNextElement()) {
                            $mates = $m->GetFields();
                        }
                        if ($mates["PROPERTY_DISCOUNT_VALUE"]) {
                            $PROP["DISCOUNT"] = 1;
                            $m_price = ($el["PROPS"]["MATERIAL_CAPACITY"]["VALUE"] * $mates["PROPERTY_BASE_PRICE_VALUE"]) - ($el["PROPS"]["MATERIAL_CAPACITY"]["VALUE"] * $mates["PROPERTY_BASE_PRICE_VALUE"] * $mates["PROPERTY_DISCOUNT_VALUE"] / 100);
                        } else {
                            $m_price = ($el["PROPS"]["MATERIAL_CAPACITY"]["VALUE"] * $mates["PROPERTY_BASE_PRICE_VALUE"]);
                        }

                        $fun = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $el["PROPS"]["LINK_TO_FUNDAMENT"]["VALUE"][0]], false, false, ["ID", "NAME", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
                        $fundam = [];
                        while ($f = $fun->GetNextElement()) {
                            $fundam = $f->GetFields();
                        }

                        if ($fundam["PROPERTY_DISCOUNT_VALUE"]) {
                            $PROP["DISCOUNT"] = 1;
                            $f_price = ($el["PROPS"]["FUNDAMENT_CAPACITY"]["VALUE"] * $fundam["PROPERTY_BASE_PRICE_VALUE"]) - ($el["PROPS"]["FUNDAMENT_CAPACITY"]["VALUE"] * $fundam["PROPERTY_BASE_PRICE_VALUE"] * $fundam["PROPERTY_DISCOUNT_VALUE"] / 100);
                        } else {
                            $f_price = ($el["PROPS"]["FUNDAMENT_CAPACITY"]["VALUE"] * $fundam["PROPERTY_BASE_PRICE_VALUE"]);
                        }
                        $price = round( $m_price + $f_price + $r_price, -2, PHP_ROUND_HALF_UP );
                    }
                    $PROP["PRICE"] = $price;
                }
                CIBlockElement::SetPropertyValuesEx($el["ID"], PROJECTS_IBLOCK_ID, $PROP);
            }
        }
    } elseif ($arFields["IBLOCK_ID"] == PROJECTS_IBLOCK_ID) {
        $props = [];
        $elems = CIBlockElement::GetList([], ["IBLOCK_ID" => PROJECTS_IBLOCK_ID, "ID" => $arFields["ID"]], false, false, ["ID", "NAME", "IBLOCK_ID"]);
        while ($ele = $elems->GetNextElement()) {
            $e = $ele->GetFields();
            $e["PROPS"] = $ele->GetProperties();
        }
        $_p_material = $arFields["PROPERTY_VALUES"][PROPERTY_MATERIAL];
        $_p_material_value = $_p_material[getFirstKey($_p_material)]["VALUE"];

        $_p_fundament = $arFields["PROPERTY_VALUES"][PROPERTY_FUNDAMENT];
        $_p_fundament_value = $_p_fundament[getFirstKey($_p_fundament)]["VALUE"];

        $_p_roof = $arFields["PROPERTY_VALUES"][PROPERTY_ROOF];
        $_p_roof_value = $_p_roof[getFirstKey($_p_roof)]["VALUE"];

        $_p_material_capacity = $arFields["PROPERTY_VALUES"][PROPERTY_MATERIAL_CAPACITY];
        $_p_material_capacity_value = $_p_material_capacity[getFirstKey($_p_material_capacity)]["VALUE"];

        $_p_fundament_capacity = $arFields["PROPERTY_VALUES"][PROPERTY_FUNDAMENT_CAPACITY];
        $_p_fundament_capacity_value = $_p_fundament_capacity[getFirstKey($_p_fundament_capacity)]["VALUE"];

        $_p_roof_capacity = $arFields["PROPERTY_VALUES"][PROPERTY_ROOF_CAPACITY];
        $_p_roof_capacity_value = $_p_roof_capacity[getFirstKey($_p_roof_capacity)]["VALUE"];



        if ($_p_material_value != $e["PROPS"]["LINK_TO_MATERIAL"]["VALUE"][0]
            || $_p_roof_value != $e["PROPS"]["LINK_TO_ROOFS"]["VALUE"][0]
            || $_p_fundament_value != $e["PROPS"]["LINK_TO_FUNDAMENT"]["VALUE"][0]
            || $_p_material_capacity_value != $e["PROPS"]["MATERIAL_CAPACITY"]["VALUE"]
            || $_p_fundament_capacity_value != $e["PROPS"]["FUNDAMENT_CAPACITY"]["VALUE"]
            || $_p_roof_capacity_value != $e["PROPS"]["ROOFS_CAPACITY"]["VALUE"]
        ){


            $material_price = 0;
            $fundament_price = 0;
            $roof_price = 0;
            $is_discount = 0;
            $price = 0;
            $mate = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $_p_material_value], false, false, ["ID", "NAME", "IBLOCK_ID", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
            $mates = [];
            while ($m = $mate->GetNextElement()) {
                $mates = $m->GetFields();
                $mates["PROPS"] = $m->GetProperties();
                if ($mates["PROPS"]["DISCOUNT"]["VALUE"]) {
                    $is_discount = 1;
                }
                $material_price = ($_p_material_capacity_value * $mates["PROPS"]["BASE_PRICE"]["VALUE"]) - ($_p_material_capacity_value * $mates["PROPS"]["BASE_PRICE"]["VALUE"] * $mates["PROPS"]["DISCOUNT"]["VALUE"] / 100);

            }

            $fate = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $_p_fundament_value], false, false, ["ID", "NAME", "IBLOCK_ID", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
            $fates = [];
            while ($f = $fate->GetNextElement()) {
                $fates = $f->GetFields();
                $fates["PROPS"] = $f->GetProperties();
                if ($fates["PROPS"]["DISCOUNT"]["VALUE"]) {
                    $is_discount = 1;
                }
                $fundament_price = ($_p_fundament_capacity_value * $fates["PROPS"]["BASE_PRICE"]["VALUE"]) - ($_p_fundament_capacity_value * $fates["PROPS"]["BASE_PRICE"]["VALUE"] * $fates["PROPS"]["DISCOUNT"]["VALUE"] / 100);

            }

            $rate = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $_p_roof_value], false, false, ["ID", "NAME", "IBLOCK_ID", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
            $rates = [];
            while ($r = $rate->GetNextElement()) {
                $rates = $r->GetFields();
                $rates["PROPS"] = $r->GetProperties();
                if ($rates["PROPS"]["DISCOUNT"]["VALUE"]) {
                    $is_discount = 1;
                }
                $roof_price = ($_p_roof_capacity_value * $rates["PROPS"]["BASE_PRICE"]["VALUE"]) - ($_p_roof_capacity_value * $rates["PROPS"]["BASE_PRICE"]["VALUE"] * $rates["PROPS"]["DISCOUNT"]["VALUE"] / 100);
            }
            $price = round( $material_price + $fundament_price + $roof_price, -2, PHP_ROUND_HALF_UP);

            $key_discount = getFirstKey($arFields["PROPERTY_VALUES"][PROPERTY_DISCOUNT]);
            $arFields["PROPERTY_VALUES"][PROPERTY_DISCOUNT][$key_discount] = $is_discount;

            $key_price = getFirstKey($arFields["PROPERTY_VALUES"][PROPERTY_PRICE]);
            $arFields["PROPERTY_VALUES"][PROPERTY_PRICE][$key_price] = $price;

            if ($price) {

                CIBlockElement::SetPropertyValuesEx($arFields["ID"], PROJECTS_IBLOCK_ID, array("PROPERTY_PRICE"=>$price, "PROPERTY_DISCOUNT"=>$is_discount));

            }

        }
    }

}

function getFirstKey($array){
    reset($array);
    $first_key = key($array);
    return $first_key;
}

function onBeforeAddProject(&$arFields)
{

    // get material roof fundament with least price

    $_p_material = $arFields["PROPERTY_VALUES"][PROPERTY_MATERIAL];
    $_p_material_value = $_p_material[getFirstKey($_p_material)]["VALUE"];

    $_p_fundament = $arFields["PROPERTY_VALUES"][PROPERTY_FUNDAMENT];
    $_p_fundament_value = $_p_fundament[getFirstKey($_p_fundament)]["VALUE"];

    $_p_roof = $arFields["PROPERTY_VALUES"][PROPERTY_ROOF];
    $_p_roof_value = $_p_roof[getFirstKey($_p_roof)]["VALUE"];





    $_p_material_capacity = $arFields["PROPERTY_VALUES"][PROPERTY_MATERIAL_CAPACITY];
    $_p_material_capacity_value = $_p_material_capacity[getFirstKey($_p_material_capacity)]["VALUE"];

    $_p_fundament_capacity = $arFields["PROPERTY_VALUES"][PROPERTY_FUNDAMENT_CAPACITY];
    $_p_fundament_capacity_value = $_p_fundament_capacity[getFirstKey($_p_fundament_capacity)]["VALUE"];

    $_p_roof_capacity = $arFields["PROPERTY_VALUES"][PROPERTY_ROOF_CAPACITY];
    $_p_roof_capacity_value = $_p_roof_capacity[getFirstKey($_p_roof_capacity)]["VALUE"];



    $material_price = 0;
    $fundament_price = 0;
    $roof_price = 0;
    $is_discount = 0;
    $price = 0;
    $mate = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $_p_material_value], false, false, ["ID", "NAME", "IBLOCK_ID", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
    $mates = [];
    while ($m = $mate->GetNextElement()) {
        $mates = $m->GetFields();
        $mates["PROPS"] = $m->GetProperties();
        if ($mates["PROPS"]["DISCOUNT"]["VALUE"]) {
            $is_discount = 1;
        }
        $material_price = ($_p_material_capacity_value * $mates["PROPS"]["BASE_PRICE"]["VALUE"]) - ($_p_material_capacity_value * $mates["PROPS"]["BASE_PRICE"]["VALUE"] * $mates["PROPS"]["DISCOUNT"]["VALUE"] / 100);
    }

    $fate = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $_p_fundament_value], false, false, ["ID", "NAME", "IBLOCK_ID", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
    $fates = [];
    while ($f = $fate->GetNextElement()) {
        $fates = $f->GetFields();
        $fates["PROPS"] = $f->GetProperties();
        if ($fates["PROPS"]["DISCOUNT"]["VALUE"]) {
            $is_discount = 1;
        }
        $fundament_price = ($_p_fundament_capacity_value * $fates["PROPS"]["BASE_PRICE"]["VALUE"]) - ($_p_fundament_capacity_value * $fates["PROPS"]["BASE_PRICE"]["VALUE"] * $fates["PROPS"]["DISCOUNT"]["VALUE"] / 100);

    }

    $rate = CIBlockElement::GetList([], ["IBLOCK_ID" => MATERIALS_IBLOCK_ID, "ID" => $_p_roof_value], false, false, ["ID", "NAME", "IBLOCK_ID", "PROPERTY_BASE_PRICE", "PROPERTY_DISCOUNT"]);
    $rates = [];
    while ($r = $rate->GetNextElement()) {
        $rates = $r->GetFields();
        $rates["PROPS"] = $r->GetProperties();
        if ($rates["PROPS"]["DISCOUNT"]["VALUE"]) {
            $is_discount = 1;
        }
        $roof_price = ($_p_roof_capacity_value * $rates["PROPS"]["BASE_PRICE"]["VALUE"]) - ($_p_roof_capacity_value * $rates["PROPS"]["BASE_PRICE"]["VALUE"] * $rates["PROPS"]["DISCOUNT"]["VALUE"] / 100);

    }

    $price = round( $material_price + $fundament_price + $roof_price, -2, PHP_ROUND_HALF_UP);

    if ($price) {

        CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array("PRICE"=>$price, "DISCOUNT"=>$is_discount));

    }

}

?>