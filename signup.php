<?php
include_once 'connection.php';
include_once 'functions.php';

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
        $query = "INSERT INTO `users` (`name`, `email`, `uid`, `pwd`) VALUES ('$name','$email','$uid','$hashpass')";
        //Te tiek definēts vaicājums, bet tas ir jāizpilda. To dara ar mysqli_query()
        mysqli_query($conn, $query);//Te jau vaicājums tiek izpildīts
    } 
    
}
?>

<?php include_once 'header.php'; ?>

    <section class="signup-form">

        <div class="signup-form-box">
            <h2>Reģistrēšanās</h2>

            <?php if(!empty($errors)): ?>
                <?php foreach($errors as $error): ?>
                    <p class="error">
                        <?= $error ?>
                    </p>  
                <?php endforeach; ?>   
            <?php endif; ?>   

            <form action="" method="post">
                <div class="input-group">
                    <input type="text" name="name" placeholder="Vārds">
                </div>
                
                <div class="input-group">
                    <input type="text" name="email" placeholder="Epasts">
                </div>

                <div class="input-group">
                    <input type="text" name="uid" placeholder="Lietotājvārds">
                </div>

                <div class="input-group">
                    <input type="password" name="pwd" placeholder="Parole">
                </div>

                <div class="input-group">
                    <input type="password" name="pwdrepeat" placeholder="Parole atkārtoti">
                </div>

                <button type="submit" name="submit">Reģistrēties</button>
            </form>
        </div>
        
    </section>
   
    <?php include_once 'footer.php'; ?>
