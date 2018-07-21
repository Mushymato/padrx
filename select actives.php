$servername = "box5570.bluehost.com";
$username = "readonly";
$password = "readonly";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

echo "Connected successfully";

$sql = "SELECT `Actives`.`actID`,
    `Actives`.`name`,
    `Actives`.`description`,
    `Actives`.`cooldown`
FROM `proticsi_PADR`.`Actives`;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<table><tr><td>actID</td><td>name</td><td>description</td><td>cooldown</td></tr>"
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo "<table><tr><td>". $row["actID"] ."</td><td>". $row["name"] ."</td><td>". $row["description"] ."</td><td>". $row["wID"] ."</td></tr>"
    }
	echo </table>
} else {
    echo "0 results";
}
$conn->close();