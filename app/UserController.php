<?php
namespace App;

class UserController {

    public function index()
    {
        $pageTitle = 'Bankas';
        $users = Json::getDB()->readData();
        require DIR.'views/index.php';
        Helper::getCurrency();
    }

    public function create()
    {
        $pageTitle = 'Atidaryti saskaita';
        require DIR.'views/create.php';
    }

    public function store()
    {
        $user = new User;
        $user->fName = (string) ($_POST['fName'] ?? '');
        $user->lName = (string) ($_POST['lName'] ?? '');
        $user->accountNum = Account::createAccountNum();
        $user->personId = $this->checkPersonId((string) ($_POST['personId'] ?? ''));
        $user->currentAmount = (float) ($_POST['currentAmount'] ?? '');

        Json::getDB()->store($user);
        header('Location: '.URL);
        die;
    }

    public function delete(int $id)
    {
        Json::getDB()->delete($id);
        header('Location: '.URL);
        die;
    }

    private function checkPersonId(string $personId)
    {
        $users = Json::getDB()->readData();
        foreach($users as $user) {
            if($user->personId == $personId || strlen($personId) < 11) {
                header('Location: '.URL);
                die;
                return;
            } else {
                return $personId;
            }
        }
        // be paskutinio kontrolinio skaiciaus
        // /^[3-6][3-9][0-9](?:0[1-9]|1[012])((?:0[1-9])|(?:1[0-2]))[0-9][0-9][1-9]/
    }


}