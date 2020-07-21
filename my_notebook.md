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
<summary>PDO</summary>

```
<?php
// setting for DataBase
    $dsn = 'mysql:dbname=DB_NAME;host=localhost';
    $user = USER;
    $password = PASSWORD;
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
?>
```
</details>

<details>
<summary>CREATE構文</summary>

### Example
```
<?php
// setting fo DB
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// CREATE
    $sql = "CREATE TABLE IF NOT EXISTS tbtest"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT"
    .");";
    $stmt = $pdo->query($sql);
?>
```

#### queryの中身1
Example中  
`
$sql = "CREATE TABLE IF NOT EXISTS tbtest"
`

| CREATE TABLE | [IF NOT EXISTS] | tbl_name | 
| :----: | :----: | :----: |
|CREATE TABLE | IF NOT EXISTS | tbtest |

#### queryの中身2
Example中  
```
. "id INT AUTO_INCREMENT PRIMARY KEY,"
. "name char(32),"
. "comment TEXT"
```

| col_name | data_type | [NOT NULL / NULL] | [DEFAULT default_val] | [AUTO_INCREMENT] | [PRIMARY KEY] |
| :------: | :------: | :------: | :------: | :------: | :------: |
| id | INT | | | AUTO_INCREMENT | PRIMARY KEY |
| name | char(32) | | | | |
|comment | TEXT | | | | |

### 構文
```
CREATE [TEMPORARY] TABLE [IF NOT EXISTS] tbl_name
    (create_definition,...)
    [table_options]
    [partition_options]

CREATE [TEMPORARY] TABLE [IF NOT EXISTS] tbl_name
    [(create_definition,...)]
    [table_options]
    [partition_options]
    select_statement

CREATE [TEMPORARY] TABLE [IF NOT EXISTS] tbl_name
    { LIKE old_tbl_name | (LIKE old_tbl_name) }

create_definition:
    col_name column_definition

column_definition:
    data_type [NOT NULL | NULL] [DEFAULT default_value]
      [AUTO_INCREMENT] [UNIQUE [KEY] | [PRIMARY] KEY]
      [COMMENT 'string']
      [COLUMN_FORMAT {FIXED|DYNAMIC|DEFAULT}]
      [STORAGE {DISK|MEMORY|DEFAULT}]
      [reference_definition]

data_type:
    BIT[(length)]
  | TINYINT[(length)] [UNSIGNED] [ZEROFILL]
  | SMALLINT[(length)] [UNSIGNED] [ZEROFILL]
  | MEDIUMINT[(length)] [UNSIGNED] [ZEROFILL]
  | INT[(length)] [UNSIGNED] [ZEROFILL]
  | INTEGER[(length)] [UNSIGNED] [ZEROFILL]
  | BIGINT[(length)] [UNSIGNED] [ZEROFILL]
  | REAL[(length,decimals)] [UNSIGNED] [ZEROFILL]
  | DOUBLE[(length,decimals)] [UNSIGNED] [ZEROFILL]
  | FLOAT[(length,decimals)] [UNSIGNED] [ZEROFILL]
  | DECIMAL[(length[,decimals])] [UNSIGNED] [ZEROFILL]
  | NUMERIC[(length[,decimals])] [UNSIGNED] [ZEROFILL]
  | DATE
  | TIME[(fsp)]
  | TIMESTAMP[(fsp)]
  | DATETIME[(fsp)]
  | YEAR
  | CHAR[(length)]
      [CHARACTER SET charset_name] [COLLATE collation_name]
  | VARCHAR(length)
      [CHARACTER SET charset_name] [COLLATE collation_name]
  | BINARY[(length)]
  | VARBINARY(length)
  | TINYBLOB
  | BLOB
  | MEDIUMBLOB
  | LONGBLOB
  | TINYTEXT [BINARY]
      [CHARACTER SET charset_name] [COLLATE collation_name]
  | TEXT [BINARY]
      [CHARACTER SET charset_name] [COLLATE collation_name]
  | MEDIUMTEXT [BINARY]
      [CHARACTER SET charset_name] [COLLATE collation_name]
  | LONGTEXT [BINARY]
      [CHARACTER SET charset_name] [COLLATE collation_name]
  | ENUM(value1,value2,value3,...)
      [CHARACTER SET charset_name] [COLLATE collation_name]
  | SET(value1,value2,value3,...)
      [CHARACTER SET charset_name] [COLLATE collation_name]
  | spatial_type

table_option:
    ENGINE [=] engine_name
  | AUTO_INCREMENT [=] value
  | AVG_ROW_LENGTH [=] value
  | [DEFAULT] CHARACTER SET [=] charset_name
  | CHECKSUM [=] {0 | 1}
  | [DEFAULT] COLLATE [=] collation_name
  | COMMENT [=] 'string'
  | CONNECTION [=] 'connect_string'
  | DATA DIRECTORY [=] 'absolute path to directory'
  | DELAY_KEY_WRITE [=] {0 | 1}
  | INDEX DIRECTORY [=] 'absolute path to directory'
  | INSERT_METHOD [=] { NO | FIRST | LAST }
  | KEY_BLOCK_SIZE [=] value
  | MAX_ROWS [=] value
  | MIN_ROWS [=] value
  | PACK_KEYS [=] {0 | 1 | DEFAULT}
  | PASSWORD [=] 'string'
  | ROW_FORMAT [=] {DEFAULT|DYNAMIC|FIXED|COMPRESSED|REDUNDANT|COMPACT}
  | STATS_AUTO_RECALC [=] {DEFAULT|0|1}
  | STATS_PERSISTENT [=] {DEFAULT|0|1}
  | STATS_SAMPLE_PAGES [=] value
  | TABLESPACE tablespace_name [STORAGE {DISK|MEMORY|DEFAULT}]
  | UNION [=] (tbl_name[,tbl_name]...)

```

### Reference
- [CREATE構文公式](https://dev.mysql.com/doc/refman/5.6/ja/create-table.html)
- [VARCHARとTEXTの違い](http://lxyuma.hatenablog.com/entry/2015/08/15/131309)
- [PDOでテーブル作成](https://gray-code.com/php/create-table-by-using-pdo/)

</details>

<details>
<summary>PRIMARY KEY</summary>

> MySQLにおいて、主キー制約が設定されたカラムの値は、ほかのカラムとの重複不可、かつnullも不可となります。
>
>そのため、ユーザーIDなどのように、データを一意に識別する必要がある場合に用いられることが多いです。

引用：https://uxmilk.jp/12787
</details>

<details>
<summary>SHOW構文</summary>

作成されているテーブルやその詳細を確認する．
### Example
```
$sql ='SHOW TABLES';
$result = $pdo -> query($sql);
foreach ($result as $row){
    echo $row[0];
    echo '<br>';
}
```

#### テーブルの詳細を表示する場合
> 指定されたテーブルを作成する`CREATE TABLE`ステートメントを表示する．
```
$sql ='SHOW CREATE TABLE tbtest';
$result = $pdo -> query($sql);
foreach ($result as $row){
    echo $row[1];
}
echo "<hr>";
```
</details>

<details>
<summary>INSERT構文</summary>

### Example
```
$sql = $pdo -> prepare("INSERT INTO テーブル名 (name, comment) VALUES (:name, :comment)");
$sql -> bindParam(':name', $name, PDO::PARAM_STR);
$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
$name = '名無し';
$comment = 'コメント';
$sql -> execute();
```
`prepare`でSQLを準備する．
テーブル名(name, comment)に対してVALUES (:name, :value) を与えている．
これにより，nameやvalueを変数のように与えることができる．
`bindParam`で変数を用いてVALUESに値を代入．
最後の`execute`で，最初に`prepare`したSQLを実行する．

### Reference
[PDOでインサートする](https://qiita.com/tabo_purify/items/0a69fd48018c4ebfd2f2)
</details>

<details>
<summary>bindParam</summary>

### Example
```
$sql -> bindParam(':name', $name, PDO::PARAM_STR);
$sql -> bindParam(':age', $age, PDO::PARAM_INT);
```
「変数」を:nameや:ageにバインドすることができる．

### Reference
[PDOでインサートする](https://qiita.com/tabo_purify/items/0a69fd48018c4ebfd2f2)
</details>

<details>
<summary>bindValue</summary>

`
$sql -> bindParam(':age', 20, PDO::PARAM_STR);
`
「値」をバインドする．

### Reference
[PDOでインサートする](https://qiita.com/tabo_purify/items/0a69fd48018c4ebfd2f2)
</details>

<details>
<summary>データの抽出(WHERE)</summary>

### Example
```
$id = 1 ; // idがこの値のデータだけを抽出したい、とする

$sql = 'SELECT * FROM tbtest WHERE id=:id ';
$stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
$stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
$stmt->execute();                             // ←SQLを実行する。
$results = $stmt->fetchAll(); 
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
    echo "<hr>";
    }
```
</details>

<details>
<summary>UPDATE構文</summary>

### Example
```
$id = 1; //変更する投稿番号
$new_name = "（変更したい名前）";
$new_comment_prev = "（変更したいコメント）"; //変更したい名前、変更したいコメントは自分で決めること
$sql = 'UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':name', $new_name, PDO::PARAM_STR);
$stmt->bindParam(':comment', $new_comment, PDO::PARAM_STR);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
```
</details>

<details>
<summary>DELETE構文</summary>

### Example
```
$id = 2;
$sql = 'delete from tbtest where id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
```
</details>

<details>
<summary>SELECT構文</summary>

### Example
```

```
</details>




<details>
<summary>title</summary>

### Example
```

```
</details>

