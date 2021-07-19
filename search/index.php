
<!--
𝗡𝗔𝗦𝗦𝗬𝗢𝗡𝗔𝗟.𝗖𝗢𝗠 | 𝟮$
-->

<?php
require_once('../login/check.php');
if(!isset($_SESSION)) 
    { 
        session_start(); 
        

    } 
?>

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
<style>
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

    <style>
        .woo {
        color: #FFD700;
        background-image: url('https://cdn.doxbin.org/gold.gif'); 
        display: inline; 
        font-weight: bold;
        
    }

    </style>

<body>
    <center>
    <div style="height: 20vh;"></div>
        <img src="../assets/OnionIcon.png" alt="Logo" height="175" width="175">
        <h1 class='search'> DB Lookup | <a class="woo"> 8,485,548  </a> recherches possible </h1>
        <br><br>
<form name="search" class="d-flex justify-content-center text-center" method="POST" action="search.php" >
                        <div class="col col-md-7" style="margin-bottom:2.5em;">
                            <div class="input-group mb-3">
                            <?php
                              if (!empty(isset($_SESSION['error']))){
                                $values = $_SESSION['error'];
                                echo $values; 
                                $_SESSION['error'] = ""; 
                              }
                              ?> 

                              <input type="text" name="data" class="form-control" placeholder="Pseudo / Email" aria-label="Pseudo or Email" aria-describedby="button-search" required="">
                              <?php 
                              $cap = rand(1, 15);
                              $cap2 = rand(1, 15);
                              $_SESSION['aws'] = intval($cap) + intval($cap2);
                              ?>
                              
                              
                              <br>
                              <input type="text" name="captcha" class="form-control" placeholder="<?php echo $cap, ' + ', $cap2, '?' ?>" aria-label="<?php echo $cap, '? ', $cap2 ?>" aria-describedby="button-search" required="">
                              <br><br><br>
                              <button class="glow-on-hover" type="button" onclick="window.location.href='../home/'">Back</button> <button class="glow-on-hover" type="submit" id="button-search">Search</button>
</body>
							
							<!--
𝗡𝗔𝗦𝗦𝗬𝗢𝗡𝗔𝗟.𝗖𝗢𝗠 | 𝟮$
-->