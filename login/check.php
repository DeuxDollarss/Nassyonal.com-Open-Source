
<!--
𝗡𝗔𝗦𝗦𝗬𝗢𝗡𝗔𝗟.𝗖𝗢𝗠 | 𝟮$
-->

<?php
if(!isset($_SESSION)) 
{ 
	session_start(); 
} 

if(isset($_SESSION['id']) & !empty($_SESSION['id'])){  
} else {
    die(header("location: ../login/index.php"));
}
?>


<!--
𝗡𝗔𝗦𝗦𝗬𝗢𝗡𝗔𝗟.𝗖𝗢𝗠 | 𝟮$
-->