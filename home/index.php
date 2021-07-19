
<!--
𝗡𝗔𝗦𝗦𝗬𝗢𝗡𝗔𝗟.𝗖𝗢𝗠 | 𝟮$
-->

<?php
require_once('../login/check.php');
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

<body>
    <style>
        .woo {
        color: #FFD700;
        background-image: url('https://cdn.doxbin.org/gold.gif'); 
        display: inline; 
        font-weight: bold;
        
    }

    </style>
    <center>
        
        <div style="height: 25vh;"></div>
        <img src="../assets/OnionIcon.png" alt="Logo" height="175" width="175">
        <h1 class='search'> Welcome <a class="woo"> <?php echo htmlspecialchars(strip_tags($_SESSION['username'])) ?>  </a> </h1>
        <br><br>
        <button class="glow-on-hover" type="button" onclick="window.location.href='logout.php'">LOGOUT</button>
        <button  class="glow-on-hover" type="button" style="width: 200px;" onclick="window.location.href='../search/'">SEARCH</button>
        <button class="glow-on-hover" type="button" onclick="window.location.href='../discord/'">DISCORD</button><br><br><br>
        <button class="glow-on-hover" type="button" onclick="window.location.href='../index.html'">Back</button>
        

</body>
	
	
<!--
𝗡𝗔𝗦𝗦𝗬𝗢𝗡𝗔𝗟.𝗖𝗢𝗠 | 𝟮$
-->