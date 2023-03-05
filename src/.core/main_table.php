<?php

class MainTable extends Table
{

    public static function getItems()
    {
        $pdo = dbPdo::getPdo();
        $sql = "SELECT main.id, main.name, main.img_path, main.id_additional, additional.name as additional_name FROM `main`
				inner join `additional` on main.id_additional = additional.id
		";
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getRuTable(): string
    {
        return 'Основная сущность';
    }

    public static function getItemById($id)
    {
        $pdo = dbPdo::getPdo();
        $sql = "SELECT main.id, main.name, main.img_path, main.id_additional FROM `main`
				inner join `additional` on main.id_additional = additional.id
				WHERE main.id = '$id'
		";
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getItemsByFilter($id){
        $pdo = dbPdo::getPdo();
        $sql = "SELECT main.id, main.name, main.img_path, main.id_additional, additional.name as additional_name FROM `main`
				inner join `additional` on main.id_additional = additional.id
                WHERE main.id_additional = '$id'
		";
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}