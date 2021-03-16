<?php

class UserController {

    public function index()
    {
        $pageTitle = 'Bankas';
        $users = Json::getDB()->readData();
        require DIR.'views/index.php';
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
        $user->accountNum = $this->createAccountNum();
        $user->personId = (int) ($_POST['personId'] ?? '');
        $user->currentAmount = (float) ($_POST['currentAmount'] ?? '');

        Json::getDB()->store($user); // sukuria
        header('Location: '.URL);
        die;
    }

    function withdraw(int $id, float $withdraw) : void
    {
        $users = readData();
        $user = getUser($id);
        if(!$user) {
            return;
        }
        $withdrawRound = round($withdraw, 2);
        if($withdraw <= 0) {
            $_SESSION['status'] = 'Ivyko klaida! Bandykite dar karta.';
            return;
        }
        $currentAmount = (float) $user['currentAmount'];
        $afterWithdraw = $currentAmount - $withdrawRound;
        $afterWithdrawRound = round($afterWithdraw, 2);
        if($afterWithdraw >= 0) {
            $user['currentAmount'] = $afterWithdrawRound;
            deleteUser($id);
            $users = readData();
            $users[] = $user;
            writeData($users);
            $_SESSION['status'] = 'Operacija atlikta sėkmingai!';
        }  else {
            $_SESSION['status'] = 'Ivyko klaida! Bandykite dar karta.';
            return;
        }
    }

    public function delete(int $id)
    {
        Json::getDB()->delete($id);
        header('Location: '.URL);
        die;
    }

    function checkPersonId(string $personId)
    {
        $users = readData();
        foreach($users as $user) {
            if($user['personId'] == $personId) {
                $_SESSION['status'] = 'Ivyko klaida! Bandykite dar karta.';
                return;
            } else {
                return $personId;
            }
        }
        // be paskutinio kontrolinio skaiciaus
        // /^[3-6][3-9][0-9](?:0[1-9]|1[012])((?:0[1-9])|(?:1[0-2]))[0-9][0-9][1-9]/
    }

    function createAccountNum() : string
    {
        $checkedNum = '01';
        $bankCode = '88000';
        // $priorAccountNum = '12345678901';
        $randAccNum = '';
        for($i = 0; $i <= 10; $i++) {
            $rand = (string) rand(0, 9);
            $randAccNum .= $rand;
        }
        $accountNum = 'LT' . $checkedNum . $bankCode . $randAccNum;
        $accountNum = (string) $accountNum;
        return $accountNum;
    }

}