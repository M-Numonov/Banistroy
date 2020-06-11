<?
AddEventHandler('main', 'OnEpilog', '_Check404Error', 1);
AddEventHandler("main", "OnUserTypeBuildList", array("CCustomTypeHtml", "GetUserTypeDescription"));
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "updatePriceAndDiscountOnChange");
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "onBeforeAddProject");
?>