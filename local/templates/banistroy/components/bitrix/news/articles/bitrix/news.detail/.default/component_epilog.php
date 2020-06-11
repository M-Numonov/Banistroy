<?
$next_page_code = "";
$arFilter = Array(
    "IBLOCK_ID"=>$arResult["IBLOCK_ID"],
    ">ID"=>$arResult["ID"],
);
$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, false, false, Array("ID", "CODE"));
if ($ar_fields = $res->GetNext()){
    $next_page_code = $ar_fields["CODE"];
}


$prev_page_code = "";
$arFilterPrev = Array(
    "IBLOCK_ID"=>$arResult["IBLOCK_ID"],
    "<ID"=>$arResult["ID"]
);
$res_next = CIBlockElement::GetList(Array("ID"=>"DESC"), $arFilterPrev, Array("ID", "CODE"));
if ($ar_fields_next = $res_next->GetNext()){
    $prev_page_code = $ar_fields_next["CODE"];
}
?>
<ul class="direction-panel">
        <?if (strlen($prev_page_code)>0):?>
            <li class="direction-panel__prev"><a href="/articles/<?= $prev_page_code ?>/">Предыдущая</a></li>
        <?endif;?>
        <?if (strlen($next_page_code)>0):?>
            <li class="direction-panel__next"><a href="/articles/<?= $next_page_code ?>/">Следующая</a></li>
        <?endif;?>
</ul>
