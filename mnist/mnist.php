<table border="1">
<tr>
    <td align="center"> input image </td>
    <td align="center"> The predicted number </td>
</tr>
<tr>
    <td width="150"> <img src="./image_dir/target_image.png"> </td>
    <td align="center" valign="center">
        <?php
        $command="python mnist.py";
        exec($command,$output);
        foreach($output as $line){
            echo $line."<br>";
        }
        ?>
</td>
</tr>
</table>
