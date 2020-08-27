<?php

    try {
        echo (new PDO(
            "mysql:host=mysql;dbname=ml;charset=utf8mb4",
            "root",
            "pass",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        ))
        ->query('select concat(\'MySQL Version :\', version()) v')
        ->fetch()['v'];
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }

// when send button is pushed
    if (isset($_POST['upload'])) {
        $image = "target_image";
// get file extention
        $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
        $file = "image_dir/$image";
        if (!empty($_FILES['image']['name'])) {
// save image to image_dir
            move_uploaded_file($_FILES['image']['tmp_name'], './image_dir/' . $image);
            if (exif_imagetype($file)) {
                $message = 'success';
            }
            else{
                $message = 'this file is not image';
            }
        }
    }

?>

<h1>Upload Image</h1>
<?php if (isset($_POST['upload'])): ?>
    <p><?php echo $message; ?></p>
    <p><a href="mnist.php">execute digit detector</a></p>
<?php else: ?>
    <form method="post" enctype="multipart/form-data">
        <p>Choose png-image</p>
        <input type="file" name="image">
        <button><input type="submit" name="upload" value="go"></button>
    </form>
<?php endif;?>
