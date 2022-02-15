<?php
include_once 'connection.php';
include_once 'functions.php';

//$q = "UPDATE users SET name = 'Miķelis' WHERE id=2";
//mysqli_query($conn, $q);

if(isset($_GET['id'])  && is_numeric($_GET['id'])){
    $id = $_GET['id'];

    $query = "SELECT * FROM users WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result); //$user saņemts kā masīvs

    if(isset($_POST['submit'])){

            $name = test_input($_POST['name']);
            $email = test_input($_POST['email']);
            $uid = test_input($_POST['uid']);
            $pwd = $_POST['pwd'];

            $errors = array();// Kļūdu masīvs

            if (empty($name)) {
                $errors["name"] = "Name is required";
            }
        
            if (empty($email)) {
                $errors["email"] = "Email is required";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Invalid email format";
            }

            $hashpass = password_hash($pwd, PASSWORD_DEFAULT);
        
            if(empty($errors)){
                //Dati ir korekti, var ievietot datubāzes tabulā: `users`
                $query = "UPDATE users SET name='$name', email='$email', uid='$uid',
                 pwd='$hashpass' WHERE id='$id'";
                //Te tiek definēts vaicājums, bet tas ir jāizpilda. To dara ar mysqli_query()
                mysqli_query($conn, $query);//Te jau vaicājums tiek izpildīts
                header("location: select.php");
            } else {
                print_r($errors);
            }
            
        }
    } else {
        header("location: select.php");
        die();
    }
    ?>
    
    <?php include_once 'header.php'; ?>

        <section class="signup-form">
            <?php if(is_array($user)): ?>
                    <div class="signup-form-box">
                    <h2>Labot</h2>
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="text" name="name" placeholder="Vārds" value="<?= $name ?? $user['name'] ?>">
                        </div>
                        
                        <div class="input-group">
                            <input type="text" name="email" placeholder="Epasts" value="<?= $email ?? $user['email'] ?>">
                        </div>

                        <div class="input-group">
                            <input type="text" name="uid" placeholder="Lietotājvārds" value="<?= $uid ?? $user['uid'] ?>">
                        </div>

                        <div class="input-group">
                            <input type="password" name="pwd" placeholder="Parole" value="<?= $pwd ?? $user['pwd'] ?>">
                        </div>

                        <div class="input-group">
                            <input type="password" name="pwdrepeat" placeholder="Parole atkārtoti" value="<?= $pwd ?? $user['pwd'] ?>">
                        </div>

                        <button type="submit" name="submit">Labot</button>
                    </form>
                </div>
            <?php else: ?>
                <p style="color :white">Tāds lietotājs nav atrasts</p>
            <?php endif; ?>
    </section>
   
    <?php include_once 'footer.php'; ?>