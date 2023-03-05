<?php
/**
 * @var string $title
 * @var string $table
 * @var array $columns
 * @var array-key $values
 */
require_once("../const.php");
include($_SERVER['DOCUMENT_ROOT'] . '/src/partials/doctype.php');
echo "<title><?= $title ?></title></head><body>";
include("../../partials/header.php");

?>
<div class="wrapper">
    <div class="container">
        <div class="bg-secondary mt-5 d-flex align-items-center">
            <a href="../../pages/<?= $table ?>Entity" class="nav-link text-white link-hover"><?= $title ?></a>
            <span class="text-white">/</span>
            <a href=""
               class="text-white nav-link"><?= isset($_GET['item_id']) ? $_GET['item_id'] : "Новая запись" ?></a>
        </div>
        <form action="#" class="form mt-5 d-flex flex-column align-items-center" method="post"
              enctype="multipart/form-data">
            <h3>Форма <?= isset($_GET['item_id']) ? ' редактирования' : " добавления" ?></h3>
            <?php if (isset($_GET['item_id'])) : ?>
                <input type="number" class="d-none" name="item_id" value="<?= $_GET['item_id'] ?>">
            <?php endif ?>
            <?php foreach ($columns as $i => $column) : if ($column == 'id') continue; ?>
                <?php if (is_int(strpos($column, 'id_')) === true) : ?>
                    <select name="item_<?= $column ?>" id="" class="form-select w-25 m-3">
                        <option value="">Выбор</option>
                        <?php foreach ($items = AdditionalTable::getItems() as $item) : ?>
                            <?php if ($values !== '' && $values[0]['id_additional'] == $item['id']) : ?>
                                <option selected value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                            <?php else : ?>
                                <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                <?php else : ?>
                    <div class="d-flex align-items-center flex-column p-3">
                        <input type="<?=is_int(strpos($column, "img_path")) ? "file" : "text" ?>"
                               class="form-control  m-3" placeholder="<?= $column ?>"
                               name="item_<?= $column ?>"
                               value="<?= !empty($values[0][$column]) ? $values[0][$column] : '' ?>"/>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <button class="btn btn-success"><?= isset($_GET['item_id']) ? 'Редактировать' : "Добавить" ?></button>
        </form>
    </div>
</div>
</body>
</html>
