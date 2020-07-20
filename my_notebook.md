# my_notebook

## PHP
<details>
<summary>date</summary>

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

変数に関する情報をダンプする．  
つまり，boolや配列の中身などを表示できる.  
return bool(true) or bool(false)  
  
### Example
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
```
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
```

### 補足
> GETはリソースを「取得」する際に仕様
> POSTはリソースに対して特有の「処理」をする際に使用
[GETとPOSTの違い](https://qiita.com/kanataxa/items/522efb74421255f0e0a1)

</details>

<details>
<summary>配列とリスト</summary>
array()

### Example
`
$weekday = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
`
もしくはarray()の短縮構文を用いて以下のように書ける．  
```
$weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

$weekday = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday"
];
```

### Example2
リストの例
```
array(
    key1 => value1,
    key2 => value2,
);
```
一部にkeyをつけることも可能
```
<?php
$items = [
    "Sunday",
    "Monday",
    "foo" => "Tuesday",
    "Wednesday",
    "Thursday",
    "Friday",
    "Saturday"
];


    echo $items[0] . "<br>";
    echo $items[1] . "<br>";
    echo $items["foo"] . "<br>";
    echo $items[2] . "<br>";
    echo $items[3] . "<br>";
    echo "<br>;
    echo var_dump($items);
?>
```
- 実行結果  
```
Sunday
Monday
Tuesday
Wednesday
Thursday

array(7) { 
    [0]=> "Sunday"
    [1]=> "Monday"
    ["foo"]=> "Tuesday"
    [2]=> "Wednesday"
    [3]=> "Thursday"
    [4]=> "Friday"
    [5]=> "Saturday"
}
```

</details>

<details>
<summary>fopen, fclose</summary>

- ファイルを開くとき  
    `
    $fp = fopen(FILE_NAME, MODE);
    `
- ファイルへの書き込み  
    `
    fwrite($fp, $str);
    `
- ファイルを閉じるとき  
    `
    fclose($fp);
    `

### Example
```
<?php
    $str = "Hello World" . PHP_EOL;
    $filename="TargetFile.txt";
    $fp = fopen($filename,"a");
    fwrite($fp,$str);
    fclose($fp);
?>
```

### modeについて
[php fopen](https://www.php.net/manual/ja/function.fopen.php)

</details>

<details>
<summary>PHP_EOL</summary>

### PHP_EOLについて
OSによって改行文字は異なるのでOSに合わせた改行文字を書きだす必要がある．  
そこで用いるのがPHP_EOL  

| OS | 改行コード文字 |
|:--:| :--:|
|Windows|\r\n|
|Mac, Linux|\n|
</details>

<details>
<summary>file_exists</summary>

ファイル，もしくはディレクトリが存在するかを確かめる．
### Example
```
if(file_exists($filename)){
    ~
}
```
</details>

<details>
<summary>file</summary>

ファイルを読み込んで配列に格納する．

### Example
```
if(file_exists($filename)){
    $lines = file($filename,FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
        ~
    }
}
```
</details>

<details>
<summary>文字分割</summary>

`
explode(string $delimiter, string $string [, int $limit_num]);
`

```
$delimiter  =   区切り文字
$string     =   対象の文字列
```

### Example
```
$string = "a,b,c,d";
$alphabet = explode(",", $string);
print_r($alphabet);
// => Array ( [0] => a [1] => b [2] => c [3] => d )
```
参考（https://blog.codecamp.jp/php-explode）  
</details>


## My SQL
### 基礎用語
<details>
<summary>SQL</summary>

読み方は「シーケル」，「シークェル」．  
データベース「言語」の1つ．  
データベースの定義や操作を行うことができる．  
SQLはISO（国際標準化機構）で規格が標準化されているので他のデータベースでも同様に操作ができる．

### Example
- Oracle Database (Oracle社)
- Microsoft SQL Server (Microsoft社)
- My SQL (オープンソース)
- Postgre SQL (オープンソース)

</details>

<details>
<summary>DSN</summary>

DSNとは，データベース（DB）につけられる名前のこと．  
SQLサーバは世界中にたくさんある．  
    -> その中でアクセスしたいサーバに名前をつけてアクセスしやすくする．
</details>

<details>
<summary>CRUD</summary>
CRUD（クラッド）は  
Create, Read, Update, Delete  
の4機能を組み合わせたもの．（データ操作に必要最低限の機能）
</details>

<details>
<summary>PDO</summary>

PDO(PHP Data Object)はPHPからデータベースへのアクセスを抽象化する．
データベースには様々な種類がある（My SQLやPostgre SQLなど）．  
これらの種類が異なるデータベースであっても同じように操作するために作られたのがPDO．  
PDOはクラスで実装されているため，実行するためにはインスタンスを生成する必要がある，
</details>

### Code
<details>
<summary></summary>


</details>







<details>
<summary>title</summary>


</details>

