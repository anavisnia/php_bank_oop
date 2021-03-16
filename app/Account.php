<?php
class Account {

    public function add()
    {
        $pageTitle = 'Prideti lesas';
        $users = Json::getDB()->readData();
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
}