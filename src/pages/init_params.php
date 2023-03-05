<?php
require_once("../const.php");
require_once("../../.core/index.php");

/**
 * @var Table $class
 * @var string $page
 */
$title = $class::getRuTable();
$columns = $class::getAllColumn();
$items = isset($_GET['filter']) ? $class::getItemsByFilter($_GET['filter']) : $class::getItems();
$table = $class::getTableName();

if (isset($_POST['item--del'])) {
    $class::del($_POST['item--del']);
    header("Location: ./");
}
if (isset($_POST['item--delWithImg'])) {
    foreach ($items as $item) {
        if ($item['id'] == $_POST['item--delWithImg']) {
            GeneralLogic::deleteImage($item['img_path']);
        }
    }
    $class::del($_POST['item--delWithImg']);
    header("Location: ./");
}

require_once("template.php");
