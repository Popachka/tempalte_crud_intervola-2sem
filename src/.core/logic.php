<?php

class GeneralLogic
{
    public static function validateName($name)
    {
        $name = htmlspecialchars($name);
        return $name;
    }

    public static function validateId($val)
    {
        if (($val = intval($val)) && ($val > 0)) {
            return $val;
        }
        return '';
    }

    public static function checkImg($files)
    {
        if (!file_exists($files['tmp_name']) || !is_uploaded_file($files['tmp_name'])) {
            return false;
        }
        $whitelist = array("image/png", "image/jpg", "image/jpeg");
        if (!in_array($files['type'], $whitelist)) {
            return false;
        }
        if ($files['size'] > 1024000) {
            return false;
        }
        return true;
    }

    public static function pushImg($files)
    {
        $uploadfile = $_SERVER['DOCUMENT_ROOT'] . "./src/img/" . $files['name'];
        move_uploaded_file($files['tmp_name'], $uploadfile);

    }
    public static function editImg($files,$old_tmp_img_name)
    {
        if (empty($files)) {
            return false;
        }
        if (!file_exists($files['tmp_name']) || !is_uploaded_file($files['tmp_name'])) {
            return false;
        }
        $whitelist = array("image/png", "image/jpg", "image/jpeg");
        if (!in_array($files['type'], $whitelist)) {
            return false;
        }
        $delFile = $_SERVER['DOCUMENT_ROOT'] . "./src/img/" . $old_tmp_img_name;
        unlink($delFile);
        $uploadfile = $_SERVER['DOCUMENT_ROOT'] . "./src/img/" . $files['name'];
        move_uploaded_file($files['tmp_name'], $uploadfile);
        return true;
    }
    public static function deleteImage(string  $img_p)
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . "./src/img/" . $img_p;
        unlink($file);

    }
}