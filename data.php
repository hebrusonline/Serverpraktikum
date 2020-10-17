<?php
//Hier werden Datenbankinhalte verwaltet.

//�berpr�fe den Grund f�r den Aufruf:
if($_POST['id'] && $_POST['name']&& $_POST['type']=='kundentabelle'){
	//Aufruf, um Zeile in Kundentabelle zu schreiben.
	insert_data_kunden('kundentabelle', $_POST);
	header('location: index.php');
}else if($_POST['pid'] && $_POST['stock']){
	//Aufruf, um Zeile in Produkttabelle zu schreiben.
	insert_data_produkte('produktdatenbank', $_POST);
}else{
	//Grund f�r Aufruf nicht ersichtlich.
	//Schreibt Zeile in die Datei '/var/log/apache2/error.log' auf Ihrem Server.
	error_log("Es ist ein Fehler aufgetreten:".$_POST['data']);	
}

//Lese Daten aus Datenbank.
function get_data($table_name){
	//Datenbank Login-Informationen.
	$host = 'localhost';
	$port = 3306;
	$dbname = '';
	$user = '';
	$pwd = '';
	
	try{
	//Datenbankverbindung hestellen.
	$conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", "$user", "$pwd");
	//Sorgt f�r lesbare Fehlermeldung.
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 
	//SQL Befehl vorbereiten.
	$selectQuery = 'SELECT * FROM '.$table_name;
	//$selectQuery = 'SELECT * FROM :table_ame';
	
	$selectStatement = $conn->prepare($selectQuery);
	//$selectStatement->bindParam(':tableName', $table_name, PDO::PARAM_STR);
	
	$selectStatement->execute();
	//$selectStatement->execute([$table_name]);	
	
    //Wenn das Ergebnis Zeilen enth�lt, solle die Ergebisse zur�ckgegeen werden.
	if($selectStatement->rowCount()){
		//Speichere alle Zeilen in result.
		$result = $selectStatement->fetchAll();
	}else{
		print "Keine Ergebnisse";
	}
		
	//Datenbankverbindung trennen.
	$conn = null;
	
	//Ergebnis zur�ckgeben.
	return $result;
	} catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}
}

function insert_data_kunden($table, $data){
	$host = 'localhost';
	$port = 3306;
	$dbname = '';
	$user = '';
	$pwd = '';
	
	try{
	//Datenbankverbindung hestellen.
	$conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", "$user", "$pwd");
	 
	//SQL Befehl ausf�hren.
	$insert_query = "INSERT INTO ".$table."(id,name) VALUES(".$data['id'].",'".$data['name']."')";

	$conn->query($insert_query);
	
	//Datenbankverbindung trennen.
	$conn = null;
	
	} catch(Exception $e){
		echo "Insert failed: " . $e->getMessage();
	}
}

function insert_data_produkte($table, $data){
	$host = 'localhost';
	$port = 3306;
	$dbname = '';
	$user = '';
	$pwd = '';
	
	try{
	//Datenbankverbindung hestellen.
	$conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", "$user", "$pwd");
	 
	//SQL Befehl ausf�hren.
	$insert_query = "UPDATE ".$table." SET lager =".$data[stock]." WHERE ".$table.".id = ".$data[pid];

	$conn->query($insert_query);
	
	//Datenbankverbindung trennen.
	$conn = null;
	
	} catch(Exception $e){
		echo "Insert failed: " . $e->getMessage();
	}
}
?>