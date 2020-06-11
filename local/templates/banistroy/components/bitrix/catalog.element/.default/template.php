<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

?>

<div class="project-info">
    <div class="project-info__slider">


        <ul class="project-info__slider__sticker-list">
            <? if ($arResult["PROPERTIES"]["XIT"]["VALUE"]): ?>
                <li><span class="product-item__sticker">Хит</span></li>
            <? endif; ?>
            <? if ($arResult["PROPERTIES"]["NEW"]["VALUE"]): ?>
                <li><span class="product-item__sticker new">new</span></li>
            <? endif; ?>
            <? if ($arResult["PROPERTIES"]["LINK_TO_MATERIAL"]["VALUE"] && $arResult["PROPERTIES"]["LINK_TO_FUNDAMENT"]["VALUE"][0] && $arResult["PROPERTIES"]["LINK_TO_ROOFS"]["VALUE"][0]): ?>
                <?
                $discount = isDiscount($arResult["PROPERTIES"]["LINK_TO_MATERIAL"]["VALUE"][0], $arResult["PROPERTIES"]["LINK_TO_FUNDAMENT"]["VALUE"][0], $arResult["PROPERTIES"]["LINK_TO_ROOFS"]["VALUE"][0]);
                ?>
                <? if ($discount["IS_DISCOUNT"]): ?>
                    <? foreach ($discount["TEXT"] as $elem): ?>
                        <li><span class="product-item__sticker percent"><?= $elem ?></span></li>
                    <? endforeach; ?>
                <? endif; ?>
            <? endif; ?>
        </ul>

        <div class="slider project-info__slider__big">
            <? foreach ($arResult["MORE_PHOTO_CUSTOM"] as $k => $mp): ?>
                <div class="project-info__slider__big__item"
                     data-responsive="<?= CFile::GetPath($mp) ?> 375, <?= CFile::GetPath($mp) ?> 480, <?= CFile::GetPath($mp) ?> 800"
                     data-src="<?= CFile::GetPath($mp) ?>" data-sub-html="<span><?= $arResult["NAME"] ?></span>">
                    <a href="#">
                        <img src="<?= ZakHelper::iResize($mp, 1000, 1000, 1) ?>" alt="<?= $arResult["NAME"] ?>"/>
                    </a>
                </div>
            <? endforeach; ?>
        </div>

        <div class="slider project-info__slider__small">

            <? foreach ($arResult["MORE_PHOTO_CUSTOM_SMALL"] as $mps): ?>
                <div class="project-info__slider__small__item">
                    <img src="<?= $mps ?>" alt="<?= $arResult["NAME"] ?>"/>
                </div>
            <? endforeach; ?>
        </div>

    </div>

    <div class="project-info__decription">
        <div class="project-info__decription__top-panel">
            <ul>
                <? foreach ($arResult["DISPLAY_PROPERTIES"] as $prop): ?>
                    <?
                    if ($prop["CODE"] == "FLOOR") $prop["NAME"] = "Этажность";
                    ?>
                    <li><?= $prop["NAME"] ?>: <strong><?= $prop["VALUE"] ?></strong></li>
                <? endforeach; ?>

                <!--                <li>Общая площадь: <strong>80 м2</strong></li>
                                <li>Этажность: <strong>2 этажа</strong></li>
                                <li>Проект и перепланировка: <strong>Бесплатно</strong></li>-->
            </ul>
        </div>
        <div class="project-info__decription__md-panel">

            <form action="" id="sku_form">
                <? foreach ($arResult["SKU"] as $k => $sku): ?>
                    <? if ($k == "MATERIALS"): ?>
                        <dl class="project-info__choice">
                            <dt>Материал:</dt>
                            <dd>
                                <div class="project-info__choice__tabs">
                                    <ul class="project-info__choice__tabs__nav">
                                        <? foreach ($sku as $y => $sk): ?>
                                            <li <?= (!$y) ? ("active") : ("") ?>>
                                                <div class="global-info-box">
                                                    <input id="<?= $sk["ID"] ?>" type="radio"
                                                           data-price="<?= $sk["PRICE"] ?>"
                                                           data-old-price="<?= $sk["OLD_PRICE"] ?>" name="material">
                                                    <label for="<?= $sk["ID"] ?>">
                                                    <span class="global-info-box__text">
                                                        <? if ($sk["IS_PRESENT"]): ?>
                                                            <span>
                                                                <xml version="1.0">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     version="1.1" id="Capa_1" x="0px" y="0px"
                                                                     viewBox="0 0 512 512" xml:space="preserve"
                                                                     width="14px" height="14px"><g><g>
                                                                    <g>
                                                                        <path d="M480,143.686H378.752c7.264-4.96,13.504-9.888,17.856-14.304c25.792-25.952,25.792-68.192,0-94.144    c-25.056-25.216-68.768-25.248-93.856,0c-13.856,13.92-50.688,70.592-45.6,108.448h-2.304    c5.056-37.856-31.744-94.528-45.6-108.448c-25.088-25.248-68.8-25.216-93.856,0C89.6,61.19,89.6,103.43,115.36,129.382    c4.384,4.416,10.624,9.344,17.888,14.304H32c-17.632,0-32,14.368-32,32v80c0,8.832,7.168,16,16,16h16v192    c0,17.632,14.368,32,32,32h384c17.632,0,32-14.368,32-32v-192h16c8.832,0,16-7.168,16-16v-80    C512,158.054,497.632,143.686,480,143.686z M138.08,57.798c6.496-6.528,15.104-10.112,24.256-10.112    c9.12,0,17.728,3.584,24.224,10.112c21.568,21.696,43.008,77.12,35.552,84.832c0,0-1.344,1.056-5.92,1.056    c-22.112,0-64.32-22.976-78.112-36.864C124.672,93.318,124.672,71.302,138.08,57.798z M240,463.686H64v-192h176V463.686z     M240,239.686H32v-64h184.192H240V239.686z M325.44,57.798c12.992-13.024,35.52-12.992,48.48,0    c13.408,13.504,13.408,35.52,0,49.024c-13.792,13.888-56,36.864-78.112,36.864c-4.576,0-5.92-1.024-5.952-1.056    C282.432,134.918,303.872,79.494,325.44,57.798z M448,463.686H272v-192h176V463.686z M480,239.686H272v-64h23.808H480V239.686z"
                                                                              data-original="#000000"
                                                                              class="active-path"
                                                                              data-old_color="#000000"
                                                                              fill="#FF0000"></path>
                                                                    </g>
                                                                    </g></g>
                                                                </svg>
                                                            </xml></span>
                                                        <? endif; ?>
                                                        <? if ($sk["IS_DISCOUNT"]): ?>
                                                            <span>%</span>
                                                        <? endif; ?>
                                                        <?= $sk["NAME"] ?></span>
                                                    </label>
                                                </div>
                                            </li>
                                        <? endforeach; ?>
                                    </ul>
                                    <? foreach ($sku as $g => $sk): ?>
                                        <div class="project-info__choice__tabs__content <?= (!$g) ? ("active") : ("") ?>">
                                            <dl class="project-info__choice indent-none">
                                                <dt>Размер <?= strtolower($sk["NAME"]) ?>:</dt>
                                                <dd>
                                                    <ul>
                                                        <? foreach ($sk["OFFERS"] as $size): ?>
                                                            <li>
                                                                <div class="global-info-box">
                                                                    <input id="<?= $size["ID"] ?>_<?= $sk["ID"] ?>"
                                                                           type="radio" name="material"
                                                                           data-price="<?= $size["PRICE"] ?>"
                                                                           data-old-price="<?= $size["OLD_PRICE"] ?>">
                                                                    <label for="<?= $size["ID"] ?>_<?= $sk["ID"] ?>">
                                                                    <span class="global-info-box__text">
                                                                        <? if ($size["IS_PRESENT"]): ?>
                                                                            <span>
                                                                <xml version="1.0">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     version="1.1" id="Capa_1" x="0px" y="0px"
                                                                     viewBox="0 0 512 512" xml:space="preserve"
                                                                     width="14px" height="14px"><g><g>
                                                                    <g>
                                                                        <path d="M480,143.686H378.752c7.264-4.96,13.504-9.888,17.856-14.304c25.792-25.952,25.792-68.192,0-94.144    c-25.056-25.216-68.768-25.248-93.856,0c-13.856,13.92-50.688,70.592-45.6,108.448h-2.304    c5.056-37.856-31.744-94.528-45.6-108.448c-25.088-25.248-68.8-25.216-93.856,0C89.6,61.19,89.6,103.43,115.36,129.382    c4.384,4.416,10.624,9.344,17.888,14.304H32c-17.632,0-32,14.368-32,32v80c0,8.832,7.168,16,16,16h16v192    c0,17.632,14.368,32,32,32h384c17.632,0,32-14.368,32-32v-192h16c8.832,0,16-7.168,16-16v-80    C512,158.054,497.632,143.686,480,143.686z M138.08,57.798c6.496-6.528,15.104-10.112,24.256-10.112    c9.12,0,17.728,3.584,24.224,10.112c21.568,21.696,43.008,77.12,35.552,84.832c0,0-1.344,1.056-5.92,1.056    c-22.112,0-64.32-22.976-78.112-36.864C124.672,93.318,124.672,71.302,138.08,57.798z M240,463.686H64v-192h176V463.686z     M240,239.686H32v-64h184.192H240V239.686z M325.44,57.798c12.992-13.024,35.52-12.992,48.48,0    c13.408,13.504,13.408,35.52,0,49.024c-13.792,13.888-56,36.864-78.112,36.864c-4.576,0-5.92-1.024-5.952-1.056    C282.432,134.918,303.872,79.494,325.44,57.798z M448,463.686H272v-192h176V463.686z M480,239.686H272v-64h23.808H480V239.686z"
                                                                              data-original="#000000"
                                                                              class="active-path"
                                                                              data-old_color="#000000"
                                                                              fill="#FF0000"></path>
                                                                    </g>
                                                                    </g></g>
                                                                </svg>
                                                            </xml></span>
                                                                        <? endif; ?>
                                                                        <? if ($size["IS_DISCOUNT"]): ?>
                                                                            <span>%</span>
                                                                        <? endif; ?>

                                                                        <?= $size["NAME"] ?></span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        <? endforeach; ?>
                                                    </ul>
                                                </dd>
                                            </dl>
                                        </div>
                                    <? endforeach; ?>
                                </div>
                            </dd>
                        </dl>
                    <? elseif ($k == "FUNDAMENTS"): ?>
                        <dl class="project-info__choice">

                            <dt>Фундамент:</dt>
                            <dd>
                                <ul>
                                    <? foreach ($sku as $sf): ?>
                                        <li>
                                            <div class="global-info-box">
                                                <input id="<?= $sf["ID"] ?>" type="radio" name="foundation"
                                                       data-price="<?= $sf["PRICE"] ?>"
                                                       data-old-price="<?= $sf["OLD_PRICE"] ?>">
                                                <label for="<?= $sf["ID"] ?>">
                                                <span class="global-info-box__text">
                                                    <? if ($sf["IS_PRESENT"]): ?>
                                                        <span>
                                                                <xml version="1.0">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     version="1.1" id="Capa_1" x="0px" y="0px"
                                                                     viewBox="0 0 512 512" xml:space="preserve"
                                                                     width="14px" height="14px"><g><g>
                                                                    <g>
                                                                        <path d="M480,143.686H378.752c7.264-4.96,13.504-9.888,17.856-14.304c25.792-25.952,25.792-68.192,0-94.144    c-25.056-25.216-68.768-25.248-93.856,0c-13.856,13.92-50.688,70.592-45.6,108.448h-2.304    c5.056-37.856-31.744-94.528-45.6-108.448c-25.088-25.248-68.8-25.216-93.856,0C89.6,61.19,89.6,103.43,115.36,129.382    c4.384,4.416,10.624,9.344,17.888,14.304H32c-17.632,0-32,14.368-32,32v80c0,8.832,7.168,16,16,16h16v192    c0,17.632,14.368,32,32,32h384c17.632,0,32-14.368,32-32v-192h16c8.832,0,16-7.168,16-16v-80    C512,158.054,497.632,143.686,480,143.686z M138.08,57.798c6.496-6.528,15.104-10.112,24.256-10.112    c9.12,0,17.728,3.584,24.224,10.112c21.568,21.696,43.008,77.12,35.552,84.832c0,0-1.344,1.056-5.92,1.056    c-22.112,0-64.32-22.976-78.112-36.864C124.672,93.318,124.672,71.302,138.08,57.798z M240,463.686H64v-192h176V463.686z     M240,239.686H32v-64h184.192H240V239.686z M325.44,57.798c12.992-13.024,35.52-12.992,48.48,0    c13.408,13.504,13.408,35.52,0,49.024c-13.792,13.888-56,36.864-78.112,36.864c-4.576,0-5.92-1.024-5.952-1.056    C282.432,134.918,303.872,79.494,325.44,57.798z M448,463.686H272v-192h176V463.686z M480,239.686H272v-64h23.808H480V239.686z"
                                                                              data-original="#000000"
                                                                              class="active-path"
                                                                              data-old_color="#000000"
                                                                              fill="#FF0000"></path>
                                                                    </g>
                                                                    </g></g>
                                                                </svg>
                                                            </xml></span>
                                                    <? endif; ?>
                                                    <? if ($sf["IS_DISCOUNT"]): ?>
                                                        <span>%</span>
                                                    <? endif; ?>
                                                    <?= $sf["NAME"] ?></span>
                                                </label>
                                            </div>
                                        </li>
                                    <? endforeach; ?>
                                </ul>
                            </dd>
                        </dl>
                    <? elseif ($k == "ROOFS"): ?>
                        <dl class="project-info__choice">
                            <dt>Кровля:</dt>
                            <dd>
                                <ul>
                                    <? foreach ($sku as $sr): ?>
                                        <li>
                                            <div class="global-info-box">
                                                <input id="<?= $sr["ID"] ?>" type="radio" name="roof"
                                                       data-price="<?= $sr["PRICE"] ?>"
                                                       data-old-price="<?= $sr["OLD_PRICE"] ?>">
                                                <label for="<?= $sr["ID"] ?>">
                                                <span class="global-info-box__text">
                                                    <? if ($sr["IS_PRESENT"]): ?>
                                                        <span>
                                                                <xml version="1.0">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                     version="1.1" id="Capa_1" x="0px" y="0px"
                                                                     viewBox="0 0 512 512" xml:space="preserve"
                                                                     width="14px" height="14px"><g><g>
                                                                    <g>
                                                                        <path d="M480,143.686H378.752c7.264-4.96,13.504-9.888,17.856-14.304c25.792-25.952,25.792-68.192,0-94.144    c-25.056-25.216-68.768-25.248-93.856,0c-13.856,13.92-50.688,70.592-45.6,108.448h-2.304    c5.056-37.856-31.744-94.528-45.6-108.448c-25.088-25.248-68.8-25.216-93.856,0C89.6,61.19,89.6,103.43,115.36,129.382    c4.384,4.416,10.624,9.344,17.888,14.304H32c-17.632,0-32,14.368-32,32v80c0,8.832,7.168,16,16,16h16v192    c0,17.632,14.368,32,32,32h384c17.632,0,32-14.368,32-32v-192h16c8.832,0,16-7.168,16-16v-80    C512,158.054,497.632,143.686,480,143.686z M138.08,57.798c6.496-6.528,15.104-10.112,24.256-10.112    c9.12,0,17.728,3.584,24.224,10.112c21.568,21.696,43.008,77.12,35.552,84.832c0,0-1.344,1.056-5.92,1.056    c-22.112,0-64.32-22.976-78.112-36.864C124.672,93.318,124.672,71.302,138.08,57.798z M240,463.686H64v-192h176V463.686z     M240,239.686H32v-64h184.192H240V239.686z M325.44,57.798c12.992-13.024,35.52-12.992,48.48,0    c13.408,13.504,13.408,35.52,0,49.024c-13.792,13.888-56,36.864-78.112,36.864c-4.576,0-5.92-1.024-5.952-1.056    C282.432,134.918,303.872,79.494,325.44,57.798z M448,463.686H272v-192h176V463.686z M480,239.686H272v-64h23.808H480V239.686z"
                                                                              data-original="#000000"
                                                                              class="active-path"
                                                                              data-old_color="#000000"
                                                                              fill="#FF0000"></path>
                                                                    </g>
                                                                    </g></g>
                                                                </svg>
                                                            </xml></span>
                                                    <? endif; ?>
                                                    <? if ($sr["IS_DISCOUNT"]): ?>
                                                        <span>%</span>
                                                    <? endif; ?>
                                                    <?= $sr["NAME"] ?></span>
                                                </label>
                                            </div>
                                        </li>
                                    <? endforeach; ?>
                                </ul>
                            </dd>
                        </dl>
                    <? endif ?>

                <? endforeach; ?>
            </form>

        </div>
        <div class="project-info__decription__bottom-panel">
            <dl>
                <dt>Цена от:</dt>
                <dd>
                    <ul class="product-item__price">
                        <li>
                            <span id="custom_price"><?= $arResult["PROPERTIES"]["PRICE"]["VALUE"] ?></span>
                            <span class="rouble">
                                                    <!--?xml version="1.0"?-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1"
                                                         enable-background="new 0 0 512 512" viewBox="0 0 512 512"><g><path
                                                                    d="m288.134 319.2c88.291 0 159.6-71.458 159.6-159.6 0-88.004-71.596-159.6-159.6-159.6h-160.667c-8.284 0-15 6.716-15 15v209.933h-33.2c-8.284 0-15 6.716-15 15v64.267c0 8.284 6.716 15 15 15h33.2v34.267h-33.2c-8.284 0-15 6.716-15 15v64.267c0 8.284 6.716 15 15 15h33.2v49.266c0 8.284 6.716 15 15 15h64.267c8.284 0 15-6.716 15-15v-49.267h97.466c8.284 0 15-6.716 15-15v-64.267c0-8.284-6.716-15-15-15h-97.467v-34.266zm-81.401-224.933h81.4c36.024 0 65.333 29.309 65.333 65.333s-29.309 65.333-65.333 65.333h-81.4z"
                                                                    data-original="#000000" class="rouble-i"
                                                                    data-old_color="#000000"></path></g> </svg>
                                                </span>
                        </li>
                        <? if (getOldPrice($arResult["ID"])): ?>
                            <li>
                                                <span class="old-price">
                                                    <span id="custom_old_price"><?= getOldPrice($arResult["ID"]) ?></span>
                                                    <span class="rouble">
                                                        <!--?xml version="1.0"?-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1"
                                                             enable-background="new 0 0 512 512" viewBox="0 0 512 512"><g><path
                                                                        d="m288.134 319.2c88.291 0 159.6-71.458 159.6-159.6 0-88.004-71.596-159.6-159.6-159.6h-160.667c-8.284 0-15 6.716-15 15v209.933h-33.2c-8.284 0-15 6.716-15 15v64.267c0 8.284 6.716 15 15 15h33.2v34.267h-33.2c-8.284 0-15 6.716-15 15v64.267c0 8.284 6.716 15 15 15h33.2v49.266c0 8.284 6.716 15 15 15h64.267c8.284 0 15-6.716 15-15v-49.267h97.466c8.284 0 15-6.716 15-15v-64.267c0-8.284-6.716-15-15-15h-97.467v-34.266zm-81.401-224.933h81.4c36.024 0 65.333 29.309 65.333 65.333s-29.309 65.333-65.333 65.333h-81.4z"
                                                                        data-original="#000000" class="rouble-i"
                                                                        data-old_color="#000000"></path></g> </svg>
                                                    </span>
                                                </span>
                            </li>
                        <? endif; ?>
                    </ul>
                </dd>
            </dl>
            <ul class="project-info__list">
                <? foreach ($arResult["SKU"]["PRESENT_LIST"] as $gift): ?>

                    <li>
                                        <span>
                                            <xml version="1.0">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                                     id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                                     xml:space="preserve" width="14px" height="14px"><g><g>
                                                    <g>
                                                        <path d="M480,143.686H378.752c7.264-4.96,13.504-9.888,17.856-14.304c25.792-25.952,25.792-68.192,0-94.144    c-25.056-25.216-68.768-25.248-93.856,0c-13.856,13.92-50.688,70.592-45.6,108.448h-2.304    c5.056-37.856-31.744-94.528-45.6-108.448c-25.088-25.248-68.8-25.216-93.856,0C89.6,61.19,89.6,103.43,115.36,129.382    c4.384,4.416,10.624,9.344,17.888,14.304H32c-17.632,0-32,14.368-32,32v80c0,8.832,7.168,16,16,16h16v192    c0,17.632,14.368,32,32,32h384c17.632,0,32-14.368,32-32v-192h16c8.832,0,16-7.168,16-16v-80    C512,158.054,497.632,143.686,480,143.686z M138.08,57.798c6.496-6.528,15.104-10.112,24.256-10.112    c9.12,0,17.728,3.584,24.224,10.112c21.568,21.696,43.008,77.12,35.552,84.832c0,0-1.344,1.056-5.92,1.056    c-22.112,0-64.32-22.976-78.112-36.864C124.672,93.318,124.672,71.302,138.08,57.798z M240,463.686H64v-192h176V463.686z     M240,239.686H32v-64h184.192H240V239.686z M325.44,57.798c12.992-13.024,35.52-12.992,48.48,0    c13.408,13.504,13.408,35.52,0,49.024c-13.792,13.888-56,36.864-78.112,36.864c-4.576,0-5.92-1.024-5.952-1.056    C282.432,134.918,303.872,79.494,325.44,57.798z M448,463.686H272v-192h176V463.686z M480,239.686H272v-64h23.808H480V239.686z"
                                                              data-original="#000000" class="active-path"
                                                              data-old_color="#000000" fill="#FF0000"/>
                                                    </g>
                                                    </g></g>
                                                </svg>
                                        </span> <?= $gift ?>
                    </li>
                <? endforeach; ?>
                <? foreach ($arResult["SKU"]["DISCOUNTS_LIST"] as $sicount): ?>
                    <li><span>%</span> <?= $sicount ?></li>
                <? endforeach; ?>
            </ul>
            <ul class="btn-panel">
                <li>
                    <a href="#" class="dec-btn" data-target="#modal4" data-toggle="modal">
                        <span>заказать проект</span>
                    </a>
                </li>
                <li>
                                        <span class="gl-link">
                                            <a href="#" data-target="#modal" data-toggle="modal">Перезвоните мне</a>
                                        </span>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="info-tabs">
    <div class="info-tabs__nav">
        <ul>
            <? if ($arResult["PROPERTIES"]["FUNDAMENT"]["VALUE"]["TEXT"]): ?>
                <li class="info-tabs__nav__item active">
                    <a href="#t1" data-toggle="tab">Фундамент</a>
                </li>
            <? endif; ?>
            <? if ($arResult["PROPERTIES"]["SETENOVOY_KOMPLEKT"]["VALUE"]["TEXT"]): ?>
                <li class="info-tabs__nav__item">
                    <a href="#t2" data-toggle="tab">Стеновой комплект</a>
                </li>
            <? endif; ?>
            <? if ($arResult["PROPERTIES"]["ROOFS"]["VALUE"]["TEXT"]): ?>
                <li class="info-tabs__nav__item">
                    <a href="#t3" data-toggle="tab">Кровля</a>
                </li>
            <? endif; ?>
            <? if ($arResult["PROPERTIES"]["OTDELKA"]["VALUE"]["TEXT"]): ?>
                <li class="info-tabs__nav__item">
                    <a href="#t4" data-toggle="tab">Отделка под ключ</a>
                </li>
            <? endif; ?>
        </ul>
    </div>
    <div class="tab-content">
        <? if ($arResult["PROPERTIES"]["FUNDAMENT"]["VALUE"]["TEXT"]): ?>
            <div class="tab-pane fade in active" id="t1">
                <?
                echo htmlspecialcharsback($arResult["PROPERTIES"]["FUNDAMENT"]["VALUE"]["TEXT"]);
                ?>
            </div>
        <? endif; ?>
        <? if ($arResult["PROPERTIES"]["SETENOVOY_KOMPLEKT"]["VALUE"]["TEXT"]): ?>
            <div class="tab-pane fade" id="t2">
                <?
                echo htmlspecialcharsback($arResult["PROPERTIES"]["SETENOVOY_KOMPLEKT"]["VALUE"]["TEXT"]);
                ?>
            </div>
        <? endif; ?>
        <? if ($arResult["PROPERTIES"]["ROOFS"]["VALUE"]["TEXT"]): ?>
            <div class="tab-pane fade" id="t3">
                <?
                echo htmlspecialcharsback($arResult["PROPERTIES"]["ROOFS"]["VALUE"]["TEXT"]);
                ?>
            </div>
        <? endif; ?>
        <? if ($arResult["PROPERTIES"]["OTDELKA"]["VALUE"]["TEXT"]): ?>
            <div class="tab-pane fade" id="t4">
                <?
                echo htmlspecialcharsback($arResult["PROPERTIES"]["OTDELKA"]["VALUE"]["TEXT"]);
                ?>
            </div>
        <? endif; ?>
    </div>
</div>

