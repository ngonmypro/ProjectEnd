<?php
function connect(){
    $servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'db_activitypro';//oci:dbname  mysql:host
	$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
function selectSql($sql){
	$conn = connect();
	//$conn->exec($sql);
	$sth = $conn->prepare($sql);
	$sth->execute();
	unset($sql);
	$rows = array();
	$result = $sth->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new RecursiveArrayIterator($sth->fetchAll()) as $k=>$v) {
        $rows[] = $v;
    }
	$conn = null;
    return $rows;
}
function in_up_delSql($sql){
	$conn = connect();
	//$conn->exec($sql);//exec
	$sth = $conn->prepare($sql);
	unset($sql);
	$sth->execute();
	$conn = null;
	return false;
}
function delAllSql($sql, $Table, $col){
	$conn = connect();
	foreach($sql as $value){
	//$conn->exec('DELETE FROM '.$Table.' WHERE '.$col.' = "'.$value.'"');
	$sth = $conn->prepare('DELETE FROM '.$Table.' WHERE '.$col.' = "'.$value.'"');
	$sth->execute();
	}
	unset($sql);
	unset($Table);
	unset($col);
	unset($value);
	$conn = null;
	return false;
}
?>
