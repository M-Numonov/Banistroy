<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $APPLICATION;
$APPLICATION->RestartBuffer();
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");
require($_SERVER["DOCUMENT_ROOT"]. SITE_TEMPLATE_PATH."/header.php");
$APPLICATION->SetTitle("Страница 404");
?>
            <ul class="bread-crumbs">
                <li>
                    <a href="/">Главная</a> /
                </li>
                <li class="active">
                    <span href="javascript:void(0)">404</span>
                </li>
            </ul>
            <div class="error-404">
                <div class="error-404__name">
                    <dl>
                        <dt>ошибка</dt>
                        <dd>404</dd>
                    </dl>
                </div>
                <div class="error-404__info">
                    <h3>Мы тоже не любим ошибки, но иногда они случаются...</h3>
                    <p>Возможно, вы перешли по неверной ссылке, страница была перемещена или ее никогда не было на сайте. Попробуйте вернуться на <a href="/">главную</a> или перейдите по одной из ссылок ниже.</p>
                </div>
            </div>
<?require($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/footer.php");?>
<?die()?>
