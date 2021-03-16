<?php
// $fName = '';
// $lName = '';
// sukurimas userio
// if($_SERVER['REQUEST_METHOD'] == 'POST') {
//     _pc($_POST);
//     $fName = (string) $_POST['fName'] ?? 'Bot';
//     $lName = (string) $_POST['lName'] ?? 'Botbot';
//     $personId = (string) $_POST['personId'] ?? '00000000000';

//     if (strlen($fName) <= 3 || empty($fName)) {
//         $fNameErr = true;
//     } elseif (isset($_POST['fName']) && !empty($_POST['fName']) && strlen($fName) > 3) {
//         $fName = (string) $_POST['fName'];
//     }

//     if (strlen($lName) <= 3 || empty($lName)) {
//         $lNameErr = true;
//     } elseif (isset($_POST['lName']) && !empty($_POST['lName']) && strlen($lName) > 3) {
//         $lName = (string) $_POST['lName'];
//     }

//     if (strlen($personId) < 11 || empty($personId)) {
//         $personIdErr = true;
//     } elseif (isset($_POST['personId']) && !empty($_POST['personId']) && strlen($personId) > 11) {
//         $users = readData();
//         foreach($users as $user) {
//             if($user['personId'] == $personId) {
//                 return $personIdErr = true;
//             }
//         }
//         $personId = (int) $_POST['personId'];
//     }

//     if (!isset($fNameErr) && !isset($lNameErr) && !isset($personIdErr)) {
//         create($fName, $lName, $personId);
//         header('Location: '.URL);
//         die;
//     }
// }
?>
<?php require DIR.'views/top.php'?>
<?php require DIR.'views/navbar.php'?>
    <section class="create_main">
        <div class="person_info_header">
            <h3>Sukurti Saskaita</h3>
        </div>
        <div class="personal_info_body">
            <form action="<?= URL ?>store" method="post">
                <div class="ul_item">
                    <label style="color: cornflowerblue;" for="fName">Vardas</label>
                    <input type="text" name="fName">
                    <?php
                        if(isset($fNameErr)) {
                            echo '<p>'.'Vardas turi buti ilgesnis nei 3 simboliai.'.'</p>';
                        }
                    ?>
                </div>
                <br>
                <div class="ul_item">
                    <label style="color: cornflowerblue;" for="lName">Pavarde</label>
                    <input type="text" name="lName">
                    <?php
                        if(isset($lNameErr)) {
                            echo '<p>'.'Pavarde turi buti ilgesnis nei 3 simboliai.'.'</p>';
                        }
                    ?>
                </div>
                <br>
                <!-- <div class="ul_item">
                    <label style="color: cornflowerblue;" for="accountNum">Saskaitos Numeris</label>
                    <input type="text" name="accountNum">
                </div>
                <br> -->
                <div class="ul_item">
                    <label style="color: cornflowerblue;" for="personId">Asmens Kodas</label>
                    <input type="number" name="personId">
                    <?php
                        if(isset( $personIdErr)) {
                            echo '<p>'.'Netaisyklingai suvesti duomenis.'.'</p>';
                        }
                    ?>
                </div>
                <br>
                <button type="submit">Sukurti Saskaita</button>
            </form>
        </div>
    </section>
<?php require DIR.'views/bottom.php'?>