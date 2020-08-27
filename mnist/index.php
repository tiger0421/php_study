<?php

$sign_up_flg = false;
$sign_in_flg = false;
$input_new_name = $_POST["new_name"];
$input_new_pass = $_POST["new_pass"];
$input_name = $_POST["name"];
$input_pass = $_POST["pass"];

// setting for Database
    try {
        $dsn = 'mysql:host=mysql;dbname=ml;charset=utf8mb4';
        $user = 'root';
        $password = 'pass';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
// create table
        $sql = "CREATE TABLE IF NOT EXISTS board"
        ." ("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "name char(32),"
        . "pass TEXT DEFAULT NULL"
        .");";
        $stmt = $pdo->query($sql);

    }
    catch (PDOException $e) {
        echo "error is occured\n";
        echo $e->getMessage();
    }

// check flag
    if($input_new_name != "" && $input_new_pass != ""){
        $sign_up_flg = true;
    }
    elseif($input_name != "" && $input_pass != ""){
        $sign_in_flg = true;
    }


    if($sign_up_flg == true){
// ###############################################
// Need to eliminate same name user

// add user
        $sql = $pdo -> prepare("INSERT INTO board (name, pass) VALUES (:name, :pass)");
        $sql -> bindParam(":name", $input_new_name, PDO::PARAM_STR);
        $sql -> bindParam(':pass', $input_new_pass, PDO::PARAM_STR);
        $sql -> execute();
    }

// Sign in
    elseif($sign_in_flg == true){
        $sql = 'SELECT * FROM board WHERE name=:name';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $input_name, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll();
        foreach ($results as $row){
            if($row['pass'] == $input_pass){
                echo "pass is OK\n";
                header('Location: ./upload_image.php');
                exit;
            }
            else{
                echo "pass is wrong \n";
            }
        }
        $sign_in_flg = false;
    }

// Form
    if( !($sign_up_flg || $sign_in_flg) ){
        echo "<hr>";
        echo "Sign up\n";
        echo '<form action="" method="post">';
        echo '<input type="name" name="new_name" placeholder="名前を入力してください">';
            echo '<input type="str" name="new_pass" placeholder="パスワードを入力してください">';
            echo '<input type="submit" name="submit">';
        echo '</form>';

        echo "<hr>";

        echo "Sign in\n";
        echo '<form action="" method="post">';
        echo '<input type="name" name="name" placeholder="名前を入力してください">';
            echo '<input type="str" name="pass" placeholder="パスワードを入力してください">';
            echo '<input type="submit" name="submit">';
        echo '</form>';

        echo "<hr>";
    }

//display record
    $sql = 'SELECT * FROM board';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    echo "<br>";
    foreach($results as $row){
        echo "name is ".$row['name'].', ';
        echo "pass is ".$row['pass'].'<br>';
    }
    echo "<hr>";

?>


