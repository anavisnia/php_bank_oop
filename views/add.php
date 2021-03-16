<?php require DIR.'views/top.php'?>
<?php require DIR.'views/navbar.php'?>
<section class='main_add'>
    <div class="person_info_header">
        <h3><?= $pageTitle ?></h3>
    </div>
    <div class="person_info_body">
            <p>Kliento Vardas: <?= $user->fName?></p>
            <p>Kliento Pavarde: <?= $user->lName?></p>
            <p>Kliento Saskaitos Nr.: <?= $user->accountNum?></p>
            <p>Kliento Saskaitos Likutis: <?= $user->currentAmount?>Eur</p>

            <form action="<?= URL ?>addAmount/<?= $user->id ?>" method="post">
                <p>Iveskite skaiciu kiek norite prideti:</p>
                <input type="text" name="addAmount" value="<?= $user->currentAmount?>">
                <p>Eur</p>
                <button type="submit">Prideti</button>
            </form>
    </div>
</section>
<?php require DIR.'views/bottom.php'?>