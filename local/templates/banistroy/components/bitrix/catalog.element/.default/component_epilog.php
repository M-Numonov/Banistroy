<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */

global $APPLICATION;


?>

<!-- modal Start -->
<div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-content__in">
                <h2 class="global-title error_formv_title" style="font-size: 25px;">Ваш заказ: <?=$arResult["NAME"]?></h2>
                <p class="error_formv"></p>
                <form id="orderCallback" method="post" action="/ajax/forms.php"
                      onsubmit="sendFormCallback(); return false;">
                    <fieldset>
                        <label class="global-label">Имя <span>*</span></label>
                        <input class="global-input" name="fio" required type="text"/>
                    </fieldset>
                    <fieldset>
                        <label class="global-label">Телефон <span>*</span></label>
                        <input class="global-input phone_for_inputmask" required name="phone" type="text"/>
                    </fieldset>
                    <fieldset>
                        <div class="checkbox">
                            <input id="feedback" type="checkbox">
                            <label for="feedback">
                                <span class="checkbox__box">&nbsp;</span>
                                <span class="checkbox__text">Нажимая кнопку "Заказать проект", вы принимаете <a href="#">условия обработки персональных данных.</a></span>
                            </label>
                        </div>
                    </fieldset>
                    <fieldset class="text-center">
                        <button class="dec-btn" type="submit">
                            <span>Заказать проект</span>
                        </button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->

<!-- modal Start -->
<div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="modal-content__in text-center">
                <h2 class="global-title indent-bt-sm">Спасибо</h2>
                <span class="notification__text">Ваша заявка принята</span>
                <a href="#" class="dec-btn" data-dismiss="modal" aria-hidden="true">
                    <span>Ок</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
