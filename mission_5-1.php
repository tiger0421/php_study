<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-1</title>
</head>
<body>
    <form action="" method="post">
        <input type="str" name="name" value="名無し" placeholder="名前を入力してください">
        <input type="str" name="comment" value="コメント" placeholder="文字を入力してください">
        <input type="str" name="pass" placeholder="パスワードを入力してください">
        <input type="submit" name="submit">
    </form>
    <form action="" method="post">
        <input type="number" name="del_num" placeholder="削除したい番号を入力してください">
        <input type="str" name="pass" placeholder="パスワードを入力してください">
        <input type="submit" name="submit">
    </form>
    <form action="" method="post">
        <input type="number" name="edit_num" placeholder="編集したい番号を入力してください">
        <input type="str" name="edit_comment" value="編集" placeholder="編集内容を入力してください">
        <input type="str" name="pass" placeholder="パスワードを入力してください">
        <input type="submit" name="submit">
    </form>


    <?php
        $post_flg = false;
        $del_flg = false;
        $edit_flg = false;
        $input_name = $_POST["name"];
        $input_comment = $_POST["comment"];
        $input_del_num = $_POST["del_num"];
        $input_edit_num = $_POST["edit_num"];
        $input_edit_comment = $_POST["edit_comment"];
        $input_pass = $_POST["pass"];
        $phrase = "を受け付けました"."<br><br>";

// setting for DataBase
    	$dsn = 'mysql:dbname=DB_NAME;host=localhost';
	    $user = 'USER';
	    $password = 'PASSWORD';
	    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// create table
	    $sql = "CREATE TABLE IF NOT EXISTS board"
	    ." ("
	    . "id INT AUTO_INCREMENT PRIMARY KEY,"
	    . "name char(32),"
        . "comment TEXT,"
//        . "time datetime DEFAULT NULL,"
        . "time TEXT,"
        . "pass TEXT DEFAULT NULL"
	    .");";
	    $stmt = $pdo->query($sql);
        
// if input_data is empty, echo Error
        if(($input_comment != "") || ($input_name != "")){
            $post_flg = true;
        }
        if(($input_del_num != "") && ($input_pass != "")){
            $del_flg = true;
        }
        if(($input_edit_num != "") && ($input_pass != "")){
            $edit_flg = true;
        }

// write a record
        if($post_flg == true){
            echo $input_comment.$phrase;
            $current_time = date("Y/m/d H:i:s");
            $sql = $pdo -> prepare("INSERT INTO board (name, comment, time, pass) VALUES (:name, :comment, :time, :pass)");
            $sql -> bindParam(":name", $input_name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $input_comment, PDO::PARAM_STR);
            $sql -> bindParam(':time', $current_time, PDO::PARAM_STR);
            $sql -> bindParam(':pass', $input_pass, PDO::PARAM_STR);
            $sql -> execute();
        }

// delete a record
        elseif($del_flg == true){
            $sql = 'SELECT * FROM board WHERE id=:id ';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $input_del_num, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(); 
            foreach ($results as $row){
                if(strcmp($row['pass'], $input_pass) == 0){
                    $sql = 'delete from board where id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $input_del_num, PDO::PARAM_INT);
                    $stmt->execute();
                }
            }
           
        }

// edit a line
        elseif($edit_flg == true){
            $current_time = date("Y/m/d H:i:s");
            $sql = 'SELECT * FROM board WHERE id=:id ';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $input_edit_num, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(); 
            foreach ($results as $row){
                if(strcmp($row['pass'], $input_pass) == 0){
                    echo $row['name']."<br>";
                    $sql = 'UPDATE board SET name=:name, comment=:comment, time=:time, pass=:pass WHERE id=:id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':id', $row['id'], PDO::PARAM_INT);
                    $stmt->bindParam(':name', $row['name'], PDO::PARAM_STR);
                    $stmt->bindParam(':comment', $input_edit_comment, PDO::PARAM_STR);
                    $stmt->bindParam(':time', $current_time, PDO::PARAM_STR);
                    $stmt->bindParam(':pass', $input_pass, PDO::PARAM_STR);
                    $stmt->execute();
                }
            }
        }

//display table
        $sql = 'SELECT * FROM board';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        foreach($results as $row){
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].',';
            echo $row['time'].'<br>';
        }
        echo "<hr>";

    ?>
</body>
</html>
