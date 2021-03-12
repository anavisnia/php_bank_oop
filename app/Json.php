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
        file_put_contents(DIR.'data/users.json', json_encode($this->data));
    }

    public function readData() : array
    {
        return $this->data;
    }

    public function writeData(array $data) : void
    {
        $this->data = json_encode($data);
    }

    public function getUser(int $id) : ?object
    {
        foreach($this->data as $user) {
            if ($user->id == $id) {
                return $user;
            }
        }
        return null;
    }

    public function store(User $user) : void
    {
        $id = $this->getNextId();
        $user->id = $id;
        $this->data[] = $user;
    }

    public function update(object $updateThisUser) : void
    {
        foreach($this->data as $key => $user) {
            if ($user->id == $updateThisUser->id) {
                $this->data[$key] = $user;
                return;
            }
        }
    }

    public function delete(int $id) : void
    {
        foreach($this->data as $key => $user) {
            if ($user->id == $id) {
                unset($this->data[$key]);
                // normalizuojam masyva iki normalaus masyvo be "skyliu"
                $this->data = array_values($this->data);
                //
                /*
                pvz indeksai pries trynima 0 1 2 3 4
                trinam 2 elementa
                indeksai po trynimo 0 1 3 4
                indeksai po normalizavimo 0 1 2 3
                */
                return;
            }
        }
    }

    private function getNextId() : int
    {
        if (!file_exists(DIR.'data/indexes.json')) {// pirmas kartas
            $index = json_encode(['id'=>1]);
            file_put_contents(DIR.'data/indexes.json', $index);
        }
        $index = file_get_contents(DIR.'data/indexes.json');
        $index = json_decode($index, 1);
        $id = (int) $index['id'];
        $index['id'] = $id + 1;
        $index = json_encode($index);
        file_put_contents(DIR.'data/indexes.json', $index);
        return $id;
    }

}