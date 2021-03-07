<?php

    session_start();

    $sqluser = "user";
    $sqlpassword = "password";

    $sqldatabase = "login";


    $post = $_SERVER['REQUEST_METHOD']=='POST';
    if ($post) {
        if(
            empty($_POST['uname'])||
            empty($_POST['pass'])
        ) $empty_fields = true;

        else {
                try {
                    $pdo = new PDO("mysql:host=localhost;dbname=".$sqldatabase,$sqluser,$sqlpassword);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    exit($e->getMessage());
                }
                $st = $pdo->prepare('SELECT * FROM list WHERE user_name=?');
                $st->execute(array($_POST['uname']));
                $r=$st->fetch();
                if($r != null && $r["password"]==$_POST['pass']) {
                    echo $_POST["uname"];
                    echo $_POST["pass"];
                    $_SESSION["uname"] = $_POST["uname"];
                    $_SESSION["pass"] = $_POST["pass"];
                    $_SESSION["fname"] = $r["first_name"];
                    echo $_SESSION["uname"];
                    echo $_SESSION["pass"];
                    header("Location:index.php");
                    exit;
                } else $login_err = true;
        }
    }
?>

<!DOCTYPE HTML>
<html>
<head>
<style type="text/css">
    body {
        margin:0px;
        padding:0px;
        font-family: sans-serif;
        font-size:.9em;
    }
    div {
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
        -ms-transform: translate(-50%,-50%);
        -moz-transform: translate(-50%,-50%);
        -webkit-transform: translate(-50%,-50%);
        position:absolute;
        width:350px;
        color: white;
        background-repeat: no-repeat;
        background-size: auto;
        background:black;
        padding:10px 20px;
        border-radius: 2px;
        box-shadow:0px 0px 840px #800000;
        box-sizing:border-box;
    }
    input {
        display: inline-block;
        border: none;

        width:100%;
        border-radius:2px;
        margin:5px 0px;
        padding:7px;
        box-sizing: border-box;
        box-shadow: 0px 0px 2px #ccc;
    }
    #submit {
        border:none;
        background-color: #323c63;
        color:white;
        font-size:1em;
        box-shadow: 0px 0px 3px #777;
        padding:10px 0px;
    }
    #submit:hover{
        background-color: #272d45;
    }
    span {
        color:red;
        font-size: 0.75em;
    }
    p {
        text-align: center;
        font-size: 1.75em;
    }
    a {
        text-decoration: none;
        color:blue;
        font-weight: bold;
    }
</style>
</head> 
<body>
    <style>
body {
  background-image: url("image/movies1.jpg");
}
</style>
<div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <p>Loguj se</p>
    <?php 
    $value1 = !empty($_POST['uname']) ? $_POST['uname'] : '';
    $value2 = !empty($_POST['pass']) ? $_POST['pass'] : '';
    echo 'Korisničko ime<br><input type="text" name="uname" value="'.$value1.'" placeholder="Korisničko ime"><br>';
    echo '<br>Šifra<br><input type="password" name="pass" value="'.$value2.'" placeholder="Šifra"><br>';
    if(!empty($login_err)&&$login_err) echo "<span>Netačno korisničko ime ili šifra.</span>";
    if(!empty($empty_fields)&&$empty_fields) echo "<span>Unesite korisničko ime i šifru.</span>";
    ?>
    <br>
    <input type="submit" id="submit" value="Loguj se" ><br><br>
    Nemate nalog? <a href="signup.php">Registruj se</a>.<br><br>
</form>
</div>
</body>
</html>