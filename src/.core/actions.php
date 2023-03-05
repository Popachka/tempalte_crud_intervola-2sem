<?php

abstract class Actions
{
    public static function add()
    {
        if (isset($_POST['item_id'])) {
            return;
        }
        $className = static::getTableName() . 'Table';
        $callColumn = "{$className}::getAllColumn";
        $callCreate = "{$className}::create";
        $columns = $callColumn();
        $columns = array_splice($columns, 1, count($columns) - 1);
        $values = [];

        for ($i = 0; $i < count($columns); $i++) {
            $name = 'item_' . $columns[$i];
            if (is_int(strpos($name, 'img_path'))) {
                continue;
            }
            if (empty($_POST[$name])) {
                return false;
            }
        }
        for ($i = 0; $i < count($columns); $i++) {
            $name = 'item_' . $columns[$i];
            if (is_int(strpos($name, 'img_path'))) {
                $values[$columns[$i]] = $_FILES['item_img_path']['name'];
                continue;
            }
            if (strpos($name, 'id') !== false) {
                $number = GeneralLogic::validateId($_POST[$name]);
                if ($number == '') {
                    return false;
                }
                $values[$columns[$i]] = $number;
            } else {
                $string = GeneralLogic::validateName($_POST[$name]);
                if ($string == '') {
                    return false;
                }
                $values[$columns[$i]] = $string;
            }

        }
        $callCreate($values);

        return true;

    }

    public static function edit()
    {
        $className = static::getTableName() . 'Table';
        $callColumn = "{$className}::getAllColumn";
        $callEdit = "{$className}::edit";
        $columns = $callColumn();
        for ($i = 0; $i < count($columns); $i++) {
            $name = 'item_' . $columns[$i];
            if (is_int(strpos($name, 'img_path'))) {
                continue;
            }
            if (empty($_POST[$name])) {
                return false;
            }
        }
        for ($i = 0; $i < count($columns); $i++) {
            $name = 'item_' . $columns[$i];
            if (is_int(strpos($name, 'img_path'))) {
                $values[$columns[$i]] = $_FILES['item_img_path']['name'];
                continue;
            }
            if (strpos($name, 'id') !== false) {
                $number = GeneralLogic::validateId($_POST[$name]);
                if ($number == '') {
                    return false;
                }
                $values[$columns[$i]] = $number;
            } else {
                $string = GeneralLogic::validateName($_POST[$name]);
                $values[$columns[$i]] = $string;
            }
        }
        $callEdit($values);

        return true;

    }

    private static function getTableName(): string
    {
        $modelName = get_called_class();

        return str_replace('Actions', '', $modelName);

    }

}