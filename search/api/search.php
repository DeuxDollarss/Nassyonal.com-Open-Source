<!--
𝗡𝗔𝗦𝗦𝗬𝗢𝗡𝗔𝗟.𝗖𝗢𝗠 | 𝟮$
-->

<?php
// *    API made by Nassyonal    *//
// *        -2021-          *//



include "db.php";

function xss($data){
    return htmlspecialchars(strip_tags($data));
}

if (!empty($_POST['data']) & isset($_POST['data']) & !empty($_POST['key']) & isset($_POST['key'])) {

    $fil2 = filter_input(INPUT_POST, 'key', FILTER_SANITIZE_SPECIAL_CHARS);

    $stmtt = $dbh->prepare("SELECT * FROM api WHERE keyy=:dat");
    $stmtt->execute(['dat' => strip_tags($fil2)]);
	$w = $stmtt->fetch();
    $ww = $stmtt->rowCount(); 

    if (!$ww > 0) {
        header('HTTP/1.0 403 Bad Request');
        die(json_encode(array("error" => true,"message" => "api key is wrong")));
    }
    
    
    $fil = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!$fil){

        header('HTTP/1.0 403 Bad Request');
        die(json_encode(array("error" => true,"message" => "corrupted data was sent please try again later..")));
    }

    if (strlen($fil) > 44) {
        header('HTTP/1.0 401 Bad Request');
        die(json_encode(array("error" => true,"message" => "TOO MANY FUKIN LETTERS")));
    }

    if (!strlen($fil) > 0){
        die(json_encode(array("error" => true,"message" => "search is empty")));
    }


    $stmt = $dbh->prepare("SELECT * FROM basic_users WHERE username=:dat OR email=:email LIMIT 500");
    $stmt->execute(['dat' => strip_tags($fil), 'email' => strip_tags($fil)]);
    $ff = $stmt->fetchAll();
    $count = $stmt->rowCount();

    if ($ff == FALSE){
        header('HTTP/1.0 401 Bad Request');
        die(json_encode(array("error" => true,"message" => "could not find ".xss($fil)." info")));
    }
    if (!$count > 0 ){
        header('HTTP/1.0 401 Bad Request');
        die(json_encode(array("error" => true,"message" => "could not find ".xss($fil)." info")));
    }
    

    foreach ($ff as $test){
        echo json_encode(array("username" => xss($test['username']), "email" => xss($test['email']), "password" => xss($test['password']), "count" => intval($count)), JSON_PRETTY_PRINT);
    }
    
} else {
    header('HTTP/1.0 403 Bad Request');
    die(json_encode(array("error" => true,"message" => "correct data was not sent")));
}
?>

<!--
𝗡𝗔𝗦𝗦𝗬𝗢𝗡𝗔𝗟.𝗖𝗢𝗠 | 𝟮$
-->