<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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

?>

    <div class="search">
        <form class="search__form"  method="get">
            <fieldset>
                <input type="text" name="q" placeholder="Запрос. <?=$_REQUEST["q"]?>">
            </fieldset>
            <fieldset>
                <button type="submit">Поиск</button>
            </fieldset>
        </form>
    </div>
<?if($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false):?>
<?elseif($arResult["ERROR_CODE"]!=0):?>
    <p><?=GetMessage("SEARCH_ERROR")?></p>
    <?ShowError($arResult["ERROR_TEXT"]);?>
    <p><?=GetMessage("SEARCH_CORRECT_AND_CONTINUE")?></p>
    <br /><br />

<?elseif(count($arResult["SEARCH"])>0):?>
    <ul class="search__list">
        <?foreach($arResult["SEARCH"] as $arItem):?>
        <li>
            <h3>
                <a href="<?echo $arItem["URL"]?>"><?echo $arItem["TITLE_FORMATED"]?></a>
            </h3>
            <p><?echo $arItem["BODY_FORMATED"]?></p>
            <?    if($arItem["CHAIN_PATH"]):?>
            <span class="search__list__path">Путь: <?=$arItem["CHAIN_PATH"]?></span>
            <?endif;?>
        </li>
      <?endforeach;?>
    </ul>
<?else:?>
    <?ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND"));?>
<?endif;?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>

<?if($arResult["REQUEST"]["HOW"]=="d"):?>
    <ul class="search__sort">
        <li class="active">
            <a href="<?=$arResult["URL"]?>&amp;how=r<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>">Сортировать по релевантности</a>
        </li>
        <li>
            <a href="javascript:void(0)">Отсортировано по дате</a>
        </li>
    </ul>
<?else:?>
    <ul class="search__sort">
        <li >
            <a href="javascript:void(0)">Отсортировано по релевантности</a>
        </li>
        <li class="active">
            <a href="<?=$arResult["URL"]?>&amp;how=d<?echo $arResult["REQUEST"]["FROM"]? '&amp;from='.$arResult["REQUEST"]["FROM"]: ''?><?echo $arResult["REQUEST"]["TO"]? '&amp;to='.$arResult["REQUEST"]["TO"]: ''?>">Сортировать по дате</a>
        </li>
    </ul>
<?endif;?>
