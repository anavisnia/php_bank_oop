<?php
namespace App;

class Account {

    public function add(int $id)
    {
        $pageTitle = 'Prideti lesas';
        $users = Json::getDB()->readData('users');
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
        $users = Json::getDB()->readData('users');
        $user = Json::getDB()->getUser($id);
        require DIR.'views/withdraw.php';
    }

    public function withdrawAmount(int $id) : void
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

    public static function getUserCurrency(int $id)
    {
        Currency::getCurrency();
        $users = Json::getDB()->readData('users');
        $user = Json::getDB()->getUser($id);
        $currentAmount = $user->currentAmount;
        $currency = Json::getDB()->readData('currency');
        $currencyNum = (float) $currency->data->rates->JPY;
        $currentCurrency = $currentAmount * $currencyNum;
        $currentCurrencyRound = round($currentCurrency, 2);
        return $currentCurrencyRound;
    }

    public static function createAccountNum() : string
    {
        $checkedNum = '01';
        $bankCode = '88000';
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