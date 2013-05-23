<?php
$email = @$_POST["email"];
//$email = "ashlygin@gmail.com";
 
if (filter_var($email, FILTER_VALIDATE_EMAIL))
{
	class MySQL
	{
		public static $server = "localhost"; //"216.172.186.233";
		public static $login = "labs42_syncftp";
		public static $password = "Tt7ikhKNxhpn";
		public static $database = "labs42_syncftp";
	}	
		
	$conn = mysql_connect(Mysql::$server, MySQL::$login, MySQL::$password) or die ("Connection refused");
	mysql_select_db(MySQL::$database, $conn);
	mysql_query("SET NAMES 'utf8'", $conn);
	
	$query = "REPLACE INTO `labs42_ftpsync`.`email` SET `email` = '" . $email . "', `remote_address` = '" . $_SERVER['REMOTE_ADDR'] . "'";
	mysql_query($query, $conn);
	
	$error = mysql_error();
    if ($error != NULL) echo '<p><b>Error:</b> '.$error.'</p>';
	
    $headers = "From: SyncFTP.net <noreply@SyncFTP.net>\r\n"
				."Content-type: text/html; charset=utf-8\r\n"
				."Content-Transfer-Encoding: quoted-printable\r\n\r\n";
	
	@mail("ashlygin@gmail.com", "SyncFTP: new email added", "Hello!\n\nFTP Service got an email: ".$email);
	@mail("alex@antipin.com", "SyncFTP: new email added", "Hello!\n\nFTP Service got an email: ".$email);
	
	mysql_close($conn);
	echo("{'success': true}");
}
else {
	echo("{'error': true}");
}
?>