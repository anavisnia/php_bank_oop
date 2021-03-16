<?php
class Account {

    public function add(int $id)
    {
        $pageTitle = 'Prideti lesas';
        $users = Json::getDB()->readData();
        $user = Json::getDB()->getUser($id);
        require DIR.'views/add.php';
       
    }

    public function addAmount(int $id) : void
    {
        $user = Json::getDB()->getUser($id);
        $addAmount = (float) ($_POST['addAmount'] ?? 0);
        $addAmountround = round($addAmount, 2);
        if($addAmountround <= 0) {
            return;
        }
        $user->currentAmount += $addAmountround;
        Json::getDB()->update($user);
        header('Location: '.URL);
        die;
    }

    public function withdraw(int $id)
    {
        $pageTitle = 'Prideti lesas';
        $users = Json::getDB()->readData();
        $user = Json::getDB()->getUser($id);
        require DIR.'views/withdraw.php';
    }

    function withdrawAmount(int $id) : void
    {
        $user = Json::getDB()->getUser($id);
        $withdraw = (float) ($_POST['withdrawAmount'] ?? 0);
        $withdrawRound = round($withdraw, 2);
        if($withdraw <= 0) {
            return;
        }
        $currentAmount = $user->currentAmount;
        $afterWithdraw = $currentAmount - $withdrawRound;
        $afterWithdrawRound = round($afterWithdraw, 2);
        if($afterWithdraw >= 0) {
            $user->currentAmount = $afterWithdrawRound;
            Json::getDB()->update($user);
        }  else {
            return;
        }
        header('Location: '.URL);
        die;
    }
}