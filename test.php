$servername = "box5570.bluehost.com";
$username = "proticsi_chuchu";
$password = "chuchu123";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

echo "Connected successfully";

$sql = "SELECT `Awakenings`.`wID`,
    `Awakenings`.`name`,
    `Awakenings`.`icon`,
    `Awakenings`.`description`,
    `Awakenings`.`tiID`
FROM `proticsi_PADR`.`Awakenings`;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["wID"]. " - Name: " . $row["name"]. " " . $row["icon"]. $row["description"] . " " . $row["tiID"] "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();