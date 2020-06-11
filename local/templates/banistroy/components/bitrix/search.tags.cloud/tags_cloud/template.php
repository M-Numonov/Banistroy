<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
if(is_array($arResult["SEARCH"]) && !empty($arResult["SEARCH"])):
    $curpage = $APPLICATION->GetCurPage();
?>
<noindex>
    <div class="projects-navi">
        <dl>
            <dt>Проекты. ваше название</dt>
            <dd>
                <ul>
    <?
		foreach ($arResult["SEARCH"] as $key => $res)
		{
		?> <li class="<?=($_REQUEST["tags"]==$res["NAME"])?("active"):("")?>"><a href="<?=$curpage?>?tags=<?=$res["NAME"]?>"  rel="nofollow"><?=$res["NAME"]?></a> </li><?
		}
    ?></ul>
            </dd>
        </dl>
    </div>
</noindex>
<?
endif;
?>

