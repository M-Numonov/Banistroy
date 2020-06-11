<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;

$aMenuLinksExt = Array(
/*    Array(
        "Каталог курсов",
        "index.php",
        Array(),
        Array(),
        ""
    ),

    Array(
        "Мои курсы",
        "mycourses.php",
        Array(),
        Array(),
        ""
    ),

    Array(
        "Журнал обучения",
        "gradebook.php",
        Array(),
        Array(),
        ""
    ),

    Array(
        "Анкета специалиста",
        "profile.php",
        Array(),
        Array(),
        ""
    ),*/
);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>