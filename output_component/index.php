<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Элементы инфоблока");

$APPLICATION->IncludeComponent(
	"danya:output.elements", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "Y",
		"ELEMENT_COUNT" => "4",
		"ELEMENT_URL" => "#SITE_DIR#/#IBLOCK_CODE#/item/id/#ELEMENT_ID#/",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "news",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>