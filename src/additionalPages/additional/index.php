<?php
require_once("../../.core/index.php");
$title = AdditionalTable::getRuTable();
$columns = AdditionalTable::getAllColumn();
$table = AdditionalTable::getTableName();
$values = isset($_GET['item_id']) ? MainTable::getItemById($_GET['item_id']) : '';

AdditionalActions::add() == true ? header("Location: ../../pages/additionalEntity/") : '';
AdditionalActions::edit() == true ? header("Location: ../../pages/additionalEntity/") : '';

require_once("../template.php");