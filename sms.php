$sql = "select * FROM USER_TABLE WHERE user_id = '" . $_SESSION['user_id'] ."'";
$result = mysql_query($sql)
or die(mysql_error());

$row = mysql_fetch_array($result);


$selNmb = mysql_query("select * from desig_nmbr") or die(mysql_error());
while($rowNmb = mysql_fetch_array($selNmb)){
$allNmb[] = $rowNmb['numb_desig'];
}

$recipient = implode(', ', $allNmb);
$msg = "Crime Alert*******";
$msg .= "From:--" . $row['fullname'] ."--------";
$msg .= "Address:--" . $row['addrs'] ."--------";
$msg .= "and has uploaded a" . $_POST['media_type'] . "as an evidence ";
$msg .= "----------------";
$msg .= $_POST['descr'];
     $to = $recipient;
        $user = "flawless";
        $pass = "gawk251coma153";
        $from = "crimeAELRT";

        $txt = $msg;
        
        $url = "http://www.kudisms.net/components/com_spc/smsapi.php?";
        $url .= "username=".$user."&password=".$pass;
        $url .= "&sender=".$from."&recipient=".$to."&message=".$msg;
        header('Location: '.$url);

break;

}
?>
KudiSMS


https://account.kudisms.net/api/?username=user&password=pass&message=test&sender=welcome&mobiles=2348030000000,2348020000000




$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
Code lines to explain from the example above:

First, we set up an SQL query that selects the id, firstname and lastname columns from the MyGuests table. The next line of code runs the query and puts the resulting data into a variable called $result.

Then, the function num_rows() checks if there are more than zero rows returned.

If there are more than zero rows returned, the function fetch_assoc() puts all the results into an associative array that we can loop through. The while() loop loops through the result set and outputs the data from the id, firstname and lastname columns.

The following example shows the same as the example above, in the MySQLi procedural way:

Example (MySQLi Procedural)
<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>