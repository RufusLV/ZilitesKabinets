<?php 
include_once 'header.php';
include_once 'connection.php';
session_start();
    $message="";
    if(count($_POST)>0) {
        $conn = mysqli_connect('localhost','root','','projekts1') or die('Unable To connect');
        $result = mysqli_query($conn,"SELECT * FROM users WHERE name='" . $_POST["name"] . "' and pwd = '". $_POST["pwd"]."'");
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] = $row['name'];
        }
        if(empty($pwd)){
            $message = "Ievadiet paroli";
        }
        if(empty($name)){
            $message = "Ievadiet lietotājvārdu";
        } else {
         $message = "Nepareiza parole un lietotājvārds";
        }
    }
    if(isset($_SESSION["id"])) {
    header("Location:index.php");
    }
?>

    <section class="signup-form">

        <div class="signup-form-box">
            <h2>Ielogošanās</h2>
            <form action="" method="post">
                <div class="input-group">
                <?php if($message!="") { echo $message; } ?>
                    <input type="text" name="name" placeholder="Lietotājvārds / Epasts">
                </div>

                <div class="input-group">
                    <input type="password" name="pwd" placeholder="Parole">
                </div>

                <button type="submit" name="submit">Ielogoties</button>
            </form>
        </div>
        
    </section>
   
    <?php include_once 'footer.php'; ?>
