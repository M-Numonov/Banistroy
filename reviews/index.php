<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы");
?>
    <div class="comments">
        <p>Прочитать отзывы и Оставить отзыв о нас на <span>Яндекс.Картах и Google Карт</span></p>
        <ul class="comments__list">
            <li>
                <div class="comments__logo">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/src/yandex-m.jpg" alt="Яндекс Карты" />
                </div>
                <?
                $APPLICATION->IncludeFile(
                  $APPLICATION->GetTemplatePath("/include_areas/reviews_yandex.php"),
                  Array(),
                  Array("MODE"=>"html")
                );
                ?>
            </li>
            <li>
                <div class="comments__logo">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/src/google-m.jpg" alt="Google Maps" />
                </div>
                <?
                $APPLICATION->IncludeFile(
                    $APPLICATION->GetTemplatePath("/include_areas/reviews_google.php"),
                    Array(),
                    Array("MODE"=>"html")
                );
                ?>
            </li>
        </ul>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>