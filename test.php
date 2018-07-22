<!DOCTYPE html>
<html>
<body>

<?php
$servername = "162.241.218.148:3306";
$username = "proticsi_chuchu";
$password = "chuchu123";

echo "Test</br>";
// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

echo "Connected successfully</br>";

$sql = "SELECT `Awakenings`.`awID`,
    `Awakenings`.`name`,
    `Awakenings`.`icon`,
    `Awakenings`.`description`,
    `Awakenings`.`tiID`
FROM `proticsi_PADR`.`Awakenings`;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["awID"]. " - Name: " . $row["name"]. " " . $row["icon"]. $row["description"] . " " . $row["tiID"] . "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();?>

</body>
</html>