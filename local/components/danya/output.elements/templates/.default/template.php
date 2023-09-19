<?php
/*
 * Файл local/components/tokmakov/iblock.random/templates/.default/template.php
 */
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="iblock-elements">
    <?foreach ($arResult['ITEMS'] as $item):?>
        <div class="iblock-element">
            <span>Ид: <?echo $item['ID']?></span>
            <span>Название: <?echo $item['NAME']?></span>
            <span>Превью текст: <?echo $item['PREVIEW_TEXT']?></span>
        </div>
    <?endforeach;?>
</div>
