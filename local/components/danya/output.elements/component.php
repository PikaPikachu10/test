<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

if (!CModule::IncludeModule('iblock')) {
    ShowError('Модуль «Информационные блоки» не установлен');
    return;
}

$arParams['IBLOCK_TYPE'] = trim($arParams['IBLOCK_TYPE']);
$arParams['IBLOCK_ID'] = intval($arParams['IBLOCK_ID']);

$arSelect = [
    'ID',
    'CODE',
    'IBLOCK_ID',
    'NAME',
    'PREVIEW_TEXT',
];

$arFilter = [
    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
    'IBLOCK_ACTIVE' => 'Y',
    'ACTIVE' => 'Y',
    'ACTIVE_DATE' => 'Y'
];

$arParams["SORT_BY1"] = trim($arParams["SORT_BY1"] ?? '');
if (empty($arParams["SORT_BY1"])) {
    $arParams["SORT_BY1"] = "ACTIVE_FROM";
}
if (
    !isset($arParams["SORT_ORDER1"])
    || !preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER1"])
) {
    $arParams["SORT_ORDER1"] = "DESC";
}

$arParams["SORT_BY2"] = trim($arParams["SORT_BY2"] ?? '');
if (empty($arParams["SORT_BY2"])) {
    if (mb_strtoupper($arParams["SORT_BY1"]) === 'SORT') {
        $arParams["SORT_BY2"] = "ID";
        $arParams["SORT_ORDER2"] = "DESC";
    } else {
        $arParams["SORT_BY2"] = "SORT";
    }
}
if (
    !isset($arParams["SORT_ORDER2"])
    || !preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER2"])
) {
    $arParams["SORT_ORDER2"] = "ASC";
}

$arSort = [
    $arParams["SORT_BY1"] => $arParams["SORT_ORDER1"],
    $arParams["SORT_BY2"] => $arParams["SORT_ORDER2"],
];

$arLimit = [
    'nTopCount' => $arParams['ELEMENT_COUNT']
];

$rsElements = CIBlockElement::GetList(
    $arSort,
    $arFilter,
    false,
    $arLimit,
    $arSelect
);

$arResult['ITEMS'] = [];
while ($arItem = $rsElements->GetNext()) {
    $arResult['ITEMS'][] = $arItem;
}

$this->IncludeComponentTemplate();