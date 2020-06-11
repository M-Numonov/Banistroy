<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>

    <ul class="contacts-list">
        <li class="contacts-list__phone">
            <dl>

                <?
                    $APPLICATION->IncludeFile(
                      $APPLICATION->GetTemplatePath("/include_areas/contacts_phone.php"),
                      Array(),
                      Array("MODE"=>"html")
                    );
                ?>
            </dl>
        </li>
        <li class="contacts-list__address">
            <dl>
                <?
                $APPLICATION->IncludeFile(
                    $APPLICATION->GetTemplatePath("/include_areas/contacts_address.php"),
                    Array(),
                    Array("MODE"=>"html")
                );
                ?>
            </dl>
        </li>
        <li class="contacts-list__mail">
            <dl>
                <?
                $APPLICATION->IncludeFile(
                    $APPLICATION->GetTemplatePath("/include_areas/contacts_mail.php"),
                    Array(),
                    Array("MODE"=>"html")
                );
                ?>
            </dl>
        </li>
    </ul>
    <div class="map">
        <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	".default", 
	array(
		"API_KEY" => "",
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "MINIMAP",
			2 => "TYPECONTROL",
			3 => "SCALELINE",
		),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.75784470347469;s:10:\"yandex_lon\";d:37.61902930764908;s:12:\"yandex_scale\";i:16;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.619479918763574;s:3:\"LAT\";d:55.75660747721712;s:4:\"TEXT\";s:27:\"Тестовой точка\";}}}",
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "",
		"MAP_WIDTH" => "1140",
		"OPTIONS" => array(
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_DRAGGING",
		),
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
<!--        <iframe class="map-b" src="https://yandex.ru/map-widget/v1/-/CBak7HDVKA" width="100%" height="400" frameborder="0"></iframe>-->
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>