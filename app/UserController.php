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
        $user->accountNum = (string) ($_POST['accountNum'] ?? '');
        $user->personId = (int) ($_POST['personId'] ?? '');
        $user->currentAmount = (float) ($_POST['currentAmount'] ?? '');

        Json::getDB()->store($user); // sukuria
        header('Location: '.URL);
        die;
    }

    function add(int $id, float $addAmount) : void
    {
        $users = readData();
        $user = getUser($id);
        if(!$user) {
            return;
        }
        $addAmountround = round($addAmount, 2);
        if($addAmountround <= 0) {
            $_SESSION['status'] = 'Ivyko klaida! Bandykite dar karta.';
            return;
        }
        $user['currentAmount'] += $addAmountround;
        deleteUser($id);
        $users = readData();
        $users[] = $user;
        writeData($users);
        $_SESSION['status'] = 'Operacija atlikta sėkmingai!';
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

    public function deleteUser(int $id)
    {
        Json::getDB()->delete($id);
        header('Location: '.URL);
        die;
    }
}