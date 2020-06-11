<?php
$GLOBALS["SECTIONS_CUSTOM"] = $arResult["SECTIONS_CUSTOM"];
/*echo preg_replace_callback(
    "/#SECTIONS#/",
    function ($matches) {
        ob_start();
//        $_COOKIE["gallery_tab"];
        $retrunStr = @ob_get_contents();
        ob_get_clean();
        return $retrunStr;
    },
    $arResult["CACHED_TPL"]);*/
?>
