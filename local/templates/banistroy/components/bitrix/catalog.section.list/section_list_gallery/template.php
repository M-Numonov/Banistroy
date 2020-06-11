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
/*ob_start();*/
if ($arResult["SECTIONS"]):?>
    <div class="info-tabs__nav">
        <ul>
            <?
            foreach ($arResult["SECTIONS"] as $k => $section): ?>
                <li class="info-tabs__nav__item <?= ($_COOKIE["gallery_tab"] == $section["ID"] || (!$k && !$_COOKIE["gallery_tab"])) ? ("active") : ("") ?>">
                    <a onclick="setCookie('gallery_tab', <?= $section["ID"] ?>, 1)" href="#t<?= $section["ID"] ?>"
                       data-toggle="tab"><?= $section["NAME"] ?></a>
                </li>
            <?endforeach; ?>
        </ul>
    </div>
<?endif;?>
<?/*$this->__component->arResult["CACHED_TPL"] = @ob_get_contents();
ob_get_clean();*/?>
