<!DOCTYPE html>

<html lang="ja">

<head>

    <meta charset="UTF-8">

    <title>mission_5-1</title>

</head>

<body>

    <?php
        $post_flg = false;
        $del_flg = false;
        $edit_flg = false;
        $show_details_flg = false;
        $all_delete_flg = false;
        $edit_select_flg = false;
        $input_name = $_POST["name"];
        $input_comment = $_POST["comment"];
        $input_del_num = $_POST["del_num"];
        $input_edit_select_num = $_POST["edit_select_num"];
        $input_edit_num = $_POST["edit_num"];
        $input_pass = $_POST["pass"];
        $phrase = "を受け付けました<br>";

// setting for DataBase
    	$dsn = 'mysql:dbname=tb220234db;host=localhost';
	    $user = 'tb-220234';
	    $password = 'nm7j7WB3bm';
	    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// create table
	    $sql = "CREATE TABLE IF NOT EXISTS board"
	    ." ("
	    . "id INT AUTO_INCREMENT PRIMARY KEY,"
	    . "name char(32),"
        . "comment TEXT,"
        . "time DATETIME DEFAULT NULL,"
        . "pass TEXT DEFAULT NULL"
	    .");";
	    $stmt = $pdo->query($sql);


// if input_data is empty, echo Error
        if(($input_comment != "") && ($input_name != "") && ($input_edit_select_num == 0)){
            $post_flg = true;
        }
        elseif(($input_del_num != "") && ($input_pass != "")){
            $del_flg = true;
        }
        elseif($input_edit_num != ""){
            
        // search the target comment
            $sql = 'SELECT * FROM board WHERE id=:id ';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $input_edit_num, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll();
            if(strcmp($results[0]['pass'], $input_pass) == 0){
                $edit_select_flg = true;
                $comment_prev = $results[0]['comment'];
            }
        }
        elseif(($input_edit_select_num != 0) && ($input_pass != "")){
            $edit_flg = true;
        }
        elseif(($input_pass != "") && (isset($_POST["show_details"]))){
            $show_details_flg = true;
        }
        elseif(($input_pass != "") && (isset($_POST["all_delete"]))){
            $all_delete_flg = true;
        }

// dispaly form
        if($edit_select_flg == false){
             echo '<form action="" method="post">';
                echo '<input type="hidden" name="edit_select_num" value=0>';
                echo '<input type="str" name="name" value="名無し" placeholder="名前を入力してください">';
                echo '<input type="str" name="comment" value="コメント" placeholder="文字を入力してください">';
                echo '<input type="str" name="pass" placeholder="パスワードを入力してください">';
                echo '<input type="submit" name="submit">';
            echo '</form>';
        }
        else{
            echo '<form action="" method="post">';
                echo '<input type="hidden" name="edit_select_num" value='.$input_edit_num.'>';
                echo '<input type="str" name="name" value="名無し" placeholder="名前を入力してください">';
                echo '<input type="str" name="comment" value='.$comment_prev.'>';
                echo '<input type="str" name="pass" placeholder="パスワードを入力してください">';
                echo '<input type="submit" name="submit">';
            echo '</form>';
        }
            echo '<form action="" method="post">';
                echo '<input type="number" name="del_num" placeholder="削除したい番号を入力してください">';
                echo '<input type="str" name="pass" placeholder="パスワードを入力してください">';
                echo '<input type="submit" name="submit">';
            echo '</form>';

            echo '<form action="" method="post">';
                echo '<input type="number" name="edit_num" placeholder="編集したい番号を入力してください">';
                echo '<input type="str" name="pass" placeholder="パスワードを入力してください">';
                echo '<input type="submit" name="submit">';
            echo '</form>';

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
            $stmt->bindParam(':id', $input_edit_select_num, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                $sql = 'UPDATE board SET name=:name, comment=:comment, time=:time, pass=:pass WHERE id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $row['id'], PDO::PARAM_INT);
                $stmt->bindParam(':name', $row['name'], PDO::PARAM_STR);
                $stmt->bindParam(':comment', $input_comment, PDO::PARAM_STR);
                $stmt->bindParam(':time', $current_time, PDO::PARAM_STR);
                $stmt->bindParam(':pass', $input_pass, PDO::PARAM_STR);
                $stmt->execute();
            }
        }

// show table
        elseif($show_details_flg == true){
            echo "table list<br><br>";
        	$sql ='SHOW TABLES';
	        $result = $pdo -> query($sql);
	        foreach ($result as $row){
		        echo $row[0];
		        echo "<br>";
	        }
	        echo "<hr>";
	        echo "table details<br><br>";
	        $sql ='SHOW CREATE TABLE board';
	        $result = $pdo -> query($sql);
        	foreach ($result as $row){
		        echo $row[1];
	        }
	        echo "<hr>";
        }

// drop table
        elseif($all_delete_flg == true){
            echo "table is dropped<br>";
            $sql = 'DROP TABLE board';
		    $stmt = $pdo->query($sql);
        }

//display table
        $sql = 'SELECT * FROM board';
        $stmt = $pdo->query($sql);
        $results = $stmt->fetchAll();
        echo "<br>";
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
