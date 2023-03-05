<?php
require_once("../../.core/index.php");
$title = MainTable::getRuTable();
$columns = MainTable::getAllColumn();

$table = MainTable::getTableName();
$values = isset($_GET['item_id']) ? MainTable::getItemById($_GET['item_id']) : '';

// Если надо проверить цену условие
// MainActions::validatePrice($_POST['item_price']); и вставить это в if с &&

if (!empty($_POST) && !empty($_FILES) && GeneralLogic::checkImg($_FILES['item_img_path'])) {
    if (MainActions::add() === true) {
        GeneralLogic::pushImg($_FILES['item_img_path']);
        header("Location: ../../pages/mainEntity");
    }
    if (MainActions::edit() === true) {
        GeneralLogic::editImg($_FILES['item_img_path'], $values[0]['img_path']);
        header("Location: ../../pages/mainEntity");
    }
}


require_once("../template.php");