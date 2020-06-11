<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовая страница");
?>
<?
// task automatically update price and discount

echo "<pre>";
print_r($_REQUEST);
echo "</pre>";

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>