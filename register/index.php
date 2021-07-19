
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
require_once('../search/api/db.php');
if(!isset($_SESSION)) 
    { 
        session_start(); 
        

    } 



if(isset($_POST) & !empty($_POST)){
    if(empty($_POST['username'])){ $errors[]="User Name field is Required"; }else{

        if (!filter_var($_POST['username'], FILTER_SANITIZE_STRING)) {
            $errors[] = "no special tags allowed in username";
        }

        $ch = strlen($_POST['username']);
        if ($ch > 20)
        {
            $errors[] = "username is to long.";
        }

        if ($ch < 2)
        {
            $errors[] = "username is to short.";
        }

        $sql = "SELECT * FROM basic_users WHERE username=?";
        $result = $dbh->prepare($sql);
        $result->execute(array(strip_tags($_POST['username'])));
        $count = $result->rowCount();
        if($count == 1){
            $errors[] = "Username already exists";
        }
    }
    if(empty($_POST['email'])){ $errors[]="E-mail field is Required"; }else{

       

        $ch = strlen($_POST['email']);
        if ($ch < 2)
        {
            $errors[] = "email is to short.";
        }

        if ($ch > 40)
        {
            $errors[] = "email is to long.";
        }

        $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

        $emailaddress = $_POST['email'];

        if (preg_match($pattern, $emailaddress) === 1) {
            $sql = "SELECT * FROM basic_users WHERE email=?";
            $result = $dbh->prepare($sql);
            $result->execute(array($_POST['email']));
            $count = $result->rowCount();
            if($count == 1){
                $errors[] = "Email already exists";
            }
        }
        else {
            $errors[] = "Not a valid email";
        }
        
    }
    
    if(empty($_POST['password'])){ $errors[]="Password field is Required"; }else{
        if(empty($_POST['passwordr'])){ $errors[]="Repeat Password field is Required"; }else{
            if($_POST['password'] == $_POST['passwordr']){
                $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }else{
                $errors[] = "Both Passwords Should Match";
            }
        }
    }
    
    if(isset($_POST['csrf_token'])){
        
        if($_POST['csrf_token'] === $_SESSION['csrf_token']){
        }else{
            $errors[] = "Problem with CSRF Token Validation";
            
        }
    }

	$max_time = 60*60*24; // in seconds
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
        $id = rand();
        $sql = "INSERT INTO basic_users (id, username, email, password) VALUES (:id, :username, :email, :password)";
        $result = $dbh->prepare($sql);
        $values = array(':username'     => $_POST['username'],
                        ':email'        => $_POST['email'],
                        ':password'     => $pass_hash,
                        ':id'           => $id
                        );
        $res = $result->execute($values);
        if($res){
            $messages[] = "User Registered";


            
            $userid = $dbh->lastInsertID();
            
            
            $values = array(':uid'          => $userid);
           

        }
    }
}

$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();


?>
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
                      <h1 class='search'>Register</h1>
                    
                </div>
                <div class="panel-body">
                    <?php
                        if(!empty($errors)){
                            echo "<div class='search'>";
                            foreach ($errors as $error) {
                                echo "<span class='search' style='color: white; background-color: transparent;'></span>&nbsp;".htmlspecialchars($error)."<br>";
                            }
                            echo "</div><br>";
                        }
                    ?>
                    <?php
                        if(!empty($messages)){
                            echo "<div class='search'>";
                            foreach ($messages as $message) {
                                echo "<span class='glyphicon glyphicon-ok'></span>&nbsp;".htmlspecialchars($message)."<br><br>";
                            }
                            echo "</div>";
                        }
                    ?>
                
                    
                    <form role="form" method="post">
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($token); ?>">
                        <div class="col col-md-7" style="margin-bottom:2.5em;">
                            <div class="input-group mb-3">
                              <input type="text" name="username" class="form-control" style="width: 240px;" placeholder="username" aria-label="username" aria-describedby="button-search" required=""><br>
                              <input type="text" name="email" class="form-control" style="width: 240px;" placeholder="email" aria-label="email" aria-describedby="button-search" required=""><br>
                              <input type="password" name="password" class="form-control" style="width: 240px;" placeholder="password" aria-label="password" aria-describedby="button-search" required=""><br>
                              <input type="password" name="passwordr" class="form-control" style="width: 240px;" placeholder="Repeat password" aria-label="rpassword" aria-describedby="button-search" required=""><br><br>
                              <button class="glow-on-hover" type="submit" style="width: 180px;" id="button-search">Register</button><br><br>
                              <button class="glow-on-hover" type="button" style="width: 180px;" onclick="window.location.href='../index.html'">Back</button>
                              
                       
                    </form>
                </div>
            </div>
        </div>
</div>


<!--
𝗡𝗔𝗦𝗦𝗬𝗢𝗡𝗔𝗟.𝗖𝗢𝗠 | 𝟮$
-->
