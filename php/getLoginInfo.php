<?php
try {

	$login_id = $_POST["login_id"];
	$word = $_POST["password"];
	// connect
	$db = new PDO("sqlite:../../maruoka_db");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$sql = "PRAGMA foreign_keys = ON";
	$db->query($sql);

	$sql = "select user_id, login_id, name, point, store_id from users
			where login_id = '$login_id'
			and password = '$word';";
	$res = $db -> query($sql);
	$data = $res -> fetchAll();

	// cutting
	$db = null;
	if (!empty($data)){

			$response["users"] = $data;

			header("Content-type: application/json; charset=UTF-8");
			echo json_encode($response);

	} else {
			echo "false";
	}

} catch (Exception $e) {

	echo $e->getMessage() . PHP_EOL;
	echo "false";

}
?>
