<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$fio = $_REQUEST["fio"];
$phone = $_REQUEST["phone"];
$captcha = $_REQUEST["captcha"];
CModule::IncludeModule("iblock");
$result = [];

if(!$captcha){
    $result["code"] = 1;
    $result["message"] = "Please check the the captcha form!";
}
$secretKey = "6LfMQrkUAAAAAK3slHK1RqAhsR4ALU_8t-ujIYxz";
$ip = $_SERVER['REMOTE_ADDR'];

// post request to server
$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array('secret' => $secretKey, 'response' => $captcha);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$response = file_get_contents($url, false, $context);
$responseKeys = json_decode($response,true);
header('Content-type: application/json');
if($responseKeys["success"]) {
    if ($_REQUEST["type"] == "callback") {
        $el = new CIBlockElement();
        $props = [];
        $props[2] = $fio;
        $props[3] = $phone;
        $props[4] = "Обратной званок";
        $name = "Заявка на обратной званок от " . $phone;
        $params = [
            "IBLOCK_ID" => IBLOCK_FORMS_ID,
            "PROPERTY_VALUES" => $props,
            "ACTIVE" => "Y",
            "NAME" => $name,
        ];
        $product_id = $el->Add($params);
        $product_id = 1;
        if ($product_id) {
            $arEventFields = array(
                "AUTHOR" => $fio,
                "TEXT" => $phone,
            );
            CEvent::Send("CALLBACK", "s1", $arEventFields);
            $result["code"] = 0;
            $result["message"] = "success";
        } else {
            $result["code"] = 1;
            $result["message"] = $el->LAST_ERROR;
        }

        echo json_encode($result);
    }
} else {
    $result["code"] = 1;
    $result["message"] = "Please check the the captcha form!";
    echo json_encode($result);
}



?>
