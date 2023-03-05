<?php

class MainActions extends Actions
{
    public static function validatePrice($price)
    {
        if ($price < 0 || $price > 1000000) {
            return false;
        }
        if (!ctype_digit($price)) {
            return false;
        }
        return true;
    }
}