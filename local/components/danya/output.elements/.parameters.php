<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!CModule::IncludeModule('iblock')) {
    return;
}

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arInfoBlocks = [];
$arFilter = ['ACTIVE' => 'Y'];

if (!empty($arCurrentValues['IBLOCK_TYPE'])) {
    $arFilter['TYPE'] = $arCurrentValues['IBLOCK_TYPE'];
}
$rsIBlock = CIBlock::GetList(
    ['SORT' => 'ASC'],
    $arFilter
);
while ($iblock = $rsIBlock->Fetch()) {
    $arInfoBlocks[$iblock['ID']] = '[' . $iblock['ID'] . '] ' . $iblock['NAME'];
}

$arSortFields = [
    "ID"=>"ID",
    "NAME"=>"Название",
    "ACTIVE_FROM"=>"Начало активности",
    "SORT"=>"Сортировка",
    "TIMESTAMP_X"=>"Дата последнего изменения",
];
$arSorts = [
    "ASC"=>"По возрастанию",
    "DESC"=>"По убыванию",
];

$arComponentParameters = [
    'PARAMETERS' => [
        'IBLOCK_TYPE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Выберите тип инфоблока',
            'TYPE' => 'LIST',
            'VALUES' => $arIBlockType,
            'REFRESH' => 'Y',
        ],
        'IBLOCK_ID' => [
            'PARENT' => 'BASE',
            'NAME' => 'Выберите инфоблок',
            'TYPE' => 'LIST',
            'VALUES' => $arInfoBlocks,
        ],
        'ELEMENT_COUNT' => [
            'PARENT' => 'BASE',
            'NAME' => 'Количество случайных элементов',
            'TYPE' => 'STRING',
            'DEFAULT' => '4',
        ],
        "SORT_BY1" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Поле для первой сортировки элементов",
            "TYPE" => "LIST",
            "DEFAULT" => "ACTIVE_FROM",
            "VALUES" => $arSortFields,
            "ADDITIONAL_VALUES" => "Y",
        ],
        "SORT_ORDER1" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Направление для первой сортировки элементов",
            "TYPE" => "LIST",
            "DEFAULT" => "DESC",
            "VALUES" => $arSorts,
            "ADDITIONAL_VALUES" => "Y",
        ],
        "SORT_BY2" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Поле для второй сортировки элементов",
            "TYPE" => "LIST",
            "DEFAULT" => "SORT",
            "VALUES" => $arSortFields,
            "ADDITIONAL_VALUES" => "Y",
        ],
        "SORT_ORDER2" => [
            "PARENT" => "DATA_SOURCE",
            "NAME" => "Направление для второй сортировки элементов",
            "TYPE" => "LIST",
            "DEFAULT" => "ASC",
            "VALUES" => $arSorts,
            "ADDITIONAL_VALUES" => "Y",
        ],
    ],
];
