<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$aMenuLinks = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DEPTH_LEVEL" => "2",
		"DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/",
		"IBLOCK_ID" => PS_IBLOCK_ID,
		"IBLOCK_TYPE" => "catalog",
		"ID" => $_REQUEST["ID"],
		"IS_SEF" => "Y",
		"SECTION_PAGE_URL" => "#SECTION_CODE#/",
		"SECTION_URL" => "",
		"SEF_BASE_URL" => "/products_i_services/"
	)
);?>