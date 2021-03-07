

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
        top:65%;
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
        box-shadow:0px 0px 1140px #800000;
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
    <style >
    body {
  background-image: url("image/movies1.jpg");
}
</style>
<div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <p>Registruj se</p>
    <?php
 

    session_start();

    $sqluser = "user";
    $sqlpassword = "password";

    $sqldatabase = "login";

    $post = $_SERVER['REQUEST_METHOD']=='POST'; 
$GLOBALS['unmatch'] = "";
$GLOBALS['fnmatch'] = "";
$GLOBALS['lnmatch'] = "";
$GLOBALS['emmatch'] = "";
$GLOBALS['pmatch'] = "";
$GLOBALS['peq'] = "";


    if ($post) {
        if(
            empty($_POST['uname'])||
            empty($_POST['fname'])||
            empty($_POST['lname'])||
            empty($_POST['email'])||
            empty($_POST['pass'])||
            empty($_POST['repass'])
        ) $empty_fields = true;

        else {
  			 $GLOBALS['unmatch'] = preg_match('/^[A-Za-z][A-Za-z0-9_]{3,}$/', $_POST['uname']);
            $GLOBALS['fnmatch'] = preg_match('/^[A-Za-z]+$/', $_POST['fname']);
            $GLOBALS['lnmatch'] = preg_match('/^[A-Za-z]+$/', $_POST['lname']);
            $GLOBALS['emmatch'] = preg_match('/^[A-Za-z_0-9]+@[A-Za-z]+.[A-Za-z]+$/', $_POST['email']);
            $GLOBALS['pmatch'] = preg_match('/.{5,}/',$_POST['pass']);
            $GLOBALS['peq'] = $_POST['pass']==$_POST['repass'];
            if($unmatch&&$fnmatch&&$lnmatch&&$emmatch&&$pmatch&&$peq) {
                try {
                    $pdo = new PDO("mysql:host=localhost;dbname=".$sqldatabase,$sqluser,$sqlpassword);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    exit($e->getMessage());
                }
                $st = $pdo->prepare('SELECT * FROM list WHERE user_name=?');
                $st->execute(array($_POST['uname']));
                $uname_err = $st->fetch() != null;
                $st = $pdo->prepare('SELECT * FROM list WHERE email=?');
                $st->execute(array($_POST['email']));
                $email_err = $st->fetch() != null;
                if(!$uname_err&&!$email_err) {
                    $stmt = 'INSERT INTO list(user_name,first_name,last_name,email,password) VALUES (?,?,?,?,?)';
                    $pdo->prepare($stmt)->execute(array(
                        $_POST['uname'],
                        $_POST['fname'],
                        $_POST['lname'],
                        $_POST['email'],
                        $_POST['pass']
                    ));
                    $_SESSION["uname"] = $_POST["uname"];
                    $_SESSION["pass"] = $_POST["pass"];
                    $_SESSION["fname"] = $_POST["fname"];
                    header("Location:index.php");
                    exit;

                    
                }
            }
        }
    }
    $empty_fields="";
    $value1 = !empty($_POST['uname']) ? $_POST['uname'] : '';
    echo 'Korisnicko ime<br><input type="text" name="uname" value="'.$value1.'" placeholder="Korisnicko ime"><br>';
    if($post&&!$empty_fields&&!$unmatch) echo '<span>Korisnicko ime mora početi sa slovom i mora imati 4 karaktera.<br></span>';
    if(!empty($uname_err)&&$uname_err) echo '<span>Korisnicko ime već postoji!Izaberite drugo.</span>';
    $value3 = !empty($_POST['fname']) ? $_POST['fname'] : '';
    echo '<br>Ime<br><input type="text" name="fname" value="'.$value3.'" placeholder="Ime"><br>';
    $value4 = !empty($_POST['lname']) ? $_POST['lname'] : '';
    echo '<input type="text" name="lname" value="'.$value4.'" placeholder="Prezime"><br>';
    if($post&&!$empty_fields&&!($lnmatch&&$fnmatch)) echo '<span>Ime mora imati slovne karaktere.<br></span>';
    $value5 = !empty($_POST['email']) ? $_POST['email'] : '';
    echo '<br>E-mail<br><input type="text" name="email" value="'.$value5.'" placeholder="email@example.com"><br>';
    if(!empty($email_err)&&$email_err) echo '<span>Email već postoji!Unesite drugi email.</span>';
    if($post&&!$empty_fields&&!$emmatch) echo '<span>Email mora biti u formatu example@site.domain<br></span>';
    echo '<br>Sifra<br><input type="password" name="pass" placeholder="Sifra"><br>';
    echo '<input type="password" name="repass" placeholder="Ponovi sifru">';
    if($post&&!$empty_fields&&!$pmatch) echo '<span>Sifra mora imati barem 5 karaktera</span>';
    if($post&&!$empty_fields&&$pmatch&&!$peq) echo '<span>Sifra se ne poklapa</span><br>';
    if($post &&$empty_fields) echo "<br><span>.</span><br>";
    ?>
    <br>
    <input type="submit" id="submit" value="Registruj se"  ><br><br>
    Već imate nalog? <a href="login.php">Loguj se</a>.<br><br>
</form>
</div>
</body>
</html>