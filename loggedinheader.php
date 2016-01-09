<?php

$appID = test_input($_GET['appid']);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$sqlQueryName = "SELECT applicantfirstname FROM applicant WHERE applicantID = $appID";
$result = $conn->query($sqlQueryName);

if ($result->num_rows != 1) {
    echo "Error retrieving data";
} else {
    $row = $result->fetch_assoc();
}

echo "<div id=\"accountLogin\">
    <p id=\"welcomeBack\">Welcome, " . $row["applicantfirstname"] . "!</p>
    <a href=\"index.php\">Log out</a>
</div>";
?>


