## my_notebook
<details>
<summary>date("str $format", int $timestamp);</summary>

現時刻が 2020/01/08 18:10:05 のとき  

| char | display |
|:---:|:---:|
|Y |2020 |
|y |20 |
|M |Jan|
|m |01 |
|D |Sat|
|d |08 |
  
| char | display |
|:---:|:---:|
|H |18 |
|h |6 |
|i |10|
|s |05|
etc.  

For details [date](https://www.php.net/manual/ja/function.date)  
  
### Example
`
$date = date("Y/m/d H:i:s");
echo "time is ".$date;
`
time is 2020/01/08 18:10:15
</details>

<details>
<summary>var_dump</summary>

return bool(true) or bool(false)  
  
###Example
`
$flg = var_dump(1>3);
`
</details>

<details>
<summary>データの受け渡し</summary>
HTMLのformを受け取る際などに使用．
$_POST

### Example
- Point
    1. <form>のmethod="post"であること
    1. <input type>のnameを$_POSTに渡すこと
`
<body>
    <form action="" method="post">
        <input type="text" name="str">
        <input type="submit" name="submit">
    </form>
    <?php
            $str = $_POST["str"];
            echo $str;
    ?>
</body>
`

### 補足
> GETはリソースを「取得」する際に仕様
> POSTはリソースに対して特有の「処理」をする際に使用
[GETとPOSTの違い](https://qiita.com/kanataxa/items/522efb74421255f0e0a1)

</details>


<details>
<summary>title</summary>


</details>

