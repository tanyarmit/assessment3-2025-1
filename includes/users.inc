<?php
require_once('includes/db_connect.inc');
$sqlusers = "SELECT DISTINCT username FROM games WHERE username IS NOT NULL AND LTRIM(RTRIM(username)) != ''";
$resultusers = $conn->query($sqlusers);
if ($resultusers->num_rows > 0) {
    // output data of each row in table
    while ($rowusers = $resultusers->fetch_assoc()) {
        $username = str_replace(' ', '', $rowusers['username']);
        $query = urlencode($rowusers['username']);
        $username = $rowusers['username'];
        print "<a href='user.php?username=$query'>$username</a>&nbsp;";
    }
}
$conn->close();
