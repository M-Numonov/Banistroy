<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
<dl class="construction__navi">
    <dd>
        <ul>
            <?
            foreach ($arResult as $arItem):
                if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                    continue;
                ?>
                <? if ($arItem["SELECTED"]):?>
                <li><a href="<?= $arItem["LINK"] ?>" class="active_left_menu"><?= $arItem["TEXT"] ?></a></li>
            <? else:?>
                <li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
            <? endif ?>

            <? endforeach ?>

        </ul>
    </dd>
</dl>
<? endif ?>
