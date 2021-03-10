<?php require DIR.'views/top.php' ?>
<?php require DIR.'views/navbar.php' ?>
<section class="hero">
        <h1>Bankas</h1>
    </section>
    <section class="saskaitu_sarasas">
        <div class="sarasas">
            <h3>Saskaitu sarasas:</h3>
            <ul class="account_list">
                <!-- <?php //foreach($users as $user) : ?> -->
                <?php foreach([] as $user) : ?>
                    <div class="ul_item">
                        <h4>Vardas: <?= $user['fName'] ?> </h4>
                        <h4>Pavarde: <?= $user['lName'] ?> </h4>
                        <h4>Saskaitos Nr. <?= $user['accountNum'] ?> </h4>
                        <h4>Likutis: <?= $user['currentAmount'] ?> Eur</h4>
                        <form action="<?= URL ?>delete.php?id=<?= $user['id'] ?>" method="post">
                            <button type="submit">Istrinti</button>
                            <a href="<?= URL ?>add.php?id=<?= $user['id'] ?>">Prideti</a>
                            <a href="<?= URL ?>withdraw.php?id=<?= $user['id'] ?>">Nuskaiciuoti</a>
                        </form>
                    </div>
                <?php endforeach ?>
                <?php
                    if(isset($_SESSION['status'])) {
                        echo '<p style="color:green;margin-left:80px;">'.$_SESSION['status'].'</p>';
                        unset($_SESSION['status']);
                    }
                ?>
            </ul>
        </div>
    </section>
    <?php require DIR.'views/bottom.php' ?>