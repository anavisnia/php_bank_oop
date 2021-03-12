<?php

class Json {
    private $data;
    private static $jsonObject;

    public static function getDB()
    {
        return self::$jsonObject ?? self::$jsonObject = new Self;
    }
    
    public function __construct()
    {
        if(!file_exists(DIR.'data/users.json')) {
            $data = json_encode([]);
            file_put_contents(DIR.'data/users.json', $data);
        }
        $data = file_get_contents(DIR.'data/users.json');
        $this->$data = json_decode($data);
    }

    public function __destruct()
    {
        file_put_contents(DIR.'data/users.json', json_decode($this->data));
    }
}