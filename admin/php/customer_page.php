<?php
//this is the main page for the site.
//include the configuration file:
require ('../../includes/config.inc.php');

//redirect if is not admin or unlogged in
if (!isset($_COOKIE['username']) || ($_COOKIE['userlevel'] == 0)) {
	$url = BASE_URL .'index.html';
	header("Location: $url");
	exit();
}
else { 
	// Need the database connection:
	require (MYSQL);
	$start = $_POST["start"];

	// Fetch all the information of users;
	$q = "SELECT user_id, username, usermail, regist_date FROM users WHERE userlevel=0 ORDER BY regist_date DESC LIMIT " + $start + ",20";
	$r = @mysqli_query($dbc, $q);

	$i = 0;
	while ($eachuser = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		$i++;
		echo 	'<tr>
					<td>' . $i . '</td>
					<td>' . $eachuser['user_id'] . '</td>
					<td>' . $eachuser['username'] . '</td>
					<td>' . $eachuser['usermail'] . '</td>
					<td>' . $eachuser['regist_date'] . '</td>
				</tr>';
	}
	mysqli_free_result($r);
	mysqli_close($dbc);


}
?>
