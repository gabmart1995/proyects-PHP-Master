<?php

class Database {
    static function connect() {
        $db = new mysqli('localhost', 'test', '123456', 'tienda_master');
        $db->query("SET NAMES 'utf-8';");

        return $db;
    }
}