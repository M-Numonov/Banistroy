<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

$aMenuLinksExt = Array(
    Array(
        "Тест",
        "index.php",
        Array(),
        Array(),
        ""
    )
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>