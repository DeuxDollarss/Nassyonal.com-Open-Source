
<!--
𝗡𝗔𝗦𝗦𝗬𝗢𝗡𝗔𝗟.𝗖𝗢𝗠 | 𝟮$
-->

<!DOCTYPE html>
<head>
    <title>
        Nassyonal.com - database lookup
    </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Permanent+Marker">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/button.css">
</head>
<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
require_once('../search/api/db.php');
require_once('chlogin.php');



if(isset($_POST) & !empty($_POST)){
    if(empty($_POST['email'])){ $errors[]="Username / Email field required"; }
    if(empty($_POST['password'])){ $errors[]="Password field is required"; }

    
    
    if(isset($_POST['csrf_token'])){
        if($_POST['csrf_token'] === $_SESSION['csrf_token']){
        }else{
            $errors[] = "Error with CSRF Token...";
        }
    } else {
        $errors[] = "Error with CSRF Token...";
    }
    $max_time = 60*60*24;
    if(isset($_SESSION['csrf_token_time'])){
        $token_time = $_SESSION['csrf_token_time'];
        if(($token_time + $max_time) >= time() ){
        }else{
            $errors[] = "CSRF Token Expired";
            unset($_SESSION['csrf_token']);
            unset($_SESSION['csrf_token_time']);
        }
    }

    if(empty($errors)){
        $sql = "SELECT * FROM basic_users WHERE ";
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $sql .= "email=?";
        }else{
            $sql .= "username=?";
        }
        $result = $dbh->prepare($sql);
        $result->execute(array($_POST['email']));
        $count = $result->rowCount();
        $res = $result->fetch(PDO::FETCH_ASSOC);
        if($count == 1){
            if(password_verify($_POST['password'], $res['password'])){
                session_regenerate_id();
                $_SESSION['login'] = true;
                $_SESSION['id'] = $res['id'];
                $_SESSION['username'] = $res['username'];
                $_SESSION['last_login'] = time();

                
                
                
                header("location: ../home/index.php");

            }else{
                $errors[] = "Username / Email & Password Not working";
            }
        }else{
            $errors[] = "Username / Email invalid";
        }
    }
}
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();
?>

    <div class="container">
        <style>
            input {
  font-family: sans-serif;
}

.al2 {
    color: white;
    background-color: transparent;
    border-color: white;
    }
</style>
<style>

input {
  font-family: sans-serif;
}
input[type=text], select {
    width: 200px;
    background-color: rgba(23, 23, 23, 23);
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    color: white;
    box-sizing: border-box;
    border-radius: 25px;
}
input[type=password], select {
    width: 200px;
    background-color: rgba(23, 23, 23, 23);
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    color: white;
    box-sizing: border-box;
    border-radius: 25px;
}

input[type=submit] {
    width: 200px;
                    
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 25px;
    cursor: pointer;
}
input[type=submit]:hover {
    background-color: #45a049;
}

</style>

<center>
<div style="height: 20vh;"></div>
            <img src="../assets/OnionIcon.png" alt="Logo" height="175" width="175">
                      <h1 class='search'>Login</h1>
                    
                    <div class="panel-body">
                        <?php
                            if(!empty($errors)){
                                echo "<div class='search'>";
                                foreach ($errors as $error) {
                                    echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;".htmlentities($error)."<br>";
                                }
                                echo "</div><br>";
                            }
                        ?>
                        <form role="form" method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo htmlentities($token); ?>">
                            <div class="col col-md-7" style="margin-bottom:2.5em;">
                            <div class="input-group mb-3">
                              <input type="text" name="email" class="form-control" style="width: 240px;" placeholder="username / email" aria-label="username" aria-describedby="button-search" required=""><br>

                              <input type="password" name="password" class="form-control" style="width: 240px;" placeholder="password" aria-label="password" aria-describedby="button-search" required=""><br><br>
                             
                              <button class="glow-on-hover" type="submit" style="width: 180px;" id="button-search">Login</button><br><br>
                              <button class="glow-on-hover" type="button" style="width: 180px;" onclick="window.location.href='../index.html'">Back</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
		
		
<!--
𝗡𝗔𝗦𝗦𝗬𝗢𝗡𝗔𝗟.𝗖𝗢𝗠 | 𝟮$
-->