<!--
𝗡𝗔𝗦𝗦𝗬𝗢𝗡𝗔𝗟.𝗖𝗢𝗠 | 𝟮$
-->

<!DOCTYPE html>
<head> 
<?php 
include "api/db.php";
require_once('../login/check.php');
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if (isset($_POST['data']) && empty($_POST['data'])){
        die(header("location: index.php"));
    }
    if (empty($_POST['captcha'])){
        die(header("location: index.php"));
    }
    if (empty($_SESSION['aws'])){
        die(header("location: index.php"));
    }
    // broken captcha easy for people to bypass just add hcaptcha 
    if ($_POST['captcha'] == $_SESSION['aws']){

    }
    else {
        $_SESSION['error'] = "<p style='color: yellow;'> captcha is wrong </p>";
        die(header('location: index.php'));   
    }

    $fil = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!$fil){

        $_SESSION['error'] = "<p style='color: yellow;'> something went wrong!! </p>";
        die(header('location: index.php'));
    }

    // char count
    if (strlen($fil) > 60) {
        
        $_SESSION['error'] = "<p style='color: yellow;'> to many letters </p>";
        die(header('location: index.php'));
    }

    if (!strlen($fil) > 0){
        $_SESSION['error'] = "<p style='color: yellow;'> search is empty </p>";
        die(header('location: index.php'));
    }

?>
<title>
        Nassyonal.com - database lookup
    </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Permanent+Marker">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/button.css">
</head>
<body>
    <center>
    <div style="height: 16vh;"></div>
        <img src="../assets/OnionIcon.png" alt="Logo" height="175" width="175">

<table class="table table-dark" style="background: black; width: 1000px; ">
  <thead>
    <tr>
    <?php
    $stmt = $dbh->prepare("SELECT * FROM users WHERE pseudo=:dat OR email=:email LIMIT 100");
    $stmt->execute(['dat' => strip_tags($fil), 'email' => strip_tags($fil)]);
    $ff = $stmt->fetchAll();
    $count = $stmt->rowCount();


    if ($ff == FALSE){
        $_SESSION['error'] = "<p style='color: yellow;'> could not find Pseudo / Email </p>";
        die(header('location: index.php'));
    }
    if (!$count > 0 ){
        $_SESSION['error'] = "<p style='color: yellow;'> could not find Pseudo / Email </p>";
        die(header('location: index.php'));
    }
    ?>
      <th scope="col">#</th>
      <th scope="col">Pseudo</th>
	  <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Ip</th>
	  <th scope="col">UUID</th>
    </tr>
  </thead>
  <tbody>

        <?php
        foreach ($ff as $test){
            echo '
            <tr>
            <th scope="row">'.intval($test['id']).'</th>
            <td>'.htmlspecialchars($test['pseudo']).'</td>
			<td>'.htmlspecialchars($test['email']).'</td>
            <td>'.htmlspecialchars($test['password']).'</td>
            <td>'.htmlspecialchars($test['ip']).'</td>
			<td>'.htmlspecialchars($test['auth-uuid']).'</td>
            </tr>
            '; 
        } 

        ?>
      
    
    
  </tbody>
</table>
<p style='color:white;'>( <?php echo intval($count)?> ) Result</p>
<br>
<button class="glow-on-hover" type="button" onclick="window.location.href='index.php'">Back</button>
</body>
	
	<!--
𝗡𝗔𝗦𝗦𝗬𝗢𝗡𝗔𝗟.𝗖𝗢𝗠 | 𝟮$
-->

