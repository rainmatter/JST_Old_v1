<?php

$empID = test_input($_GET['empid']);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    //$data = htmlspecialchars($data);
    return $data;
}

$sqlQueryName = "SELECT employeefirstname FROM employee WHERE employeeID = $empID";
$result = $conn->query($sqlQueryName);

if ($result->num_rows != 1) {
    echo "Error retrieving data";
} else {
    $row = $result->fetch_assoc();
}

echo "<div id=\"accountLogin\">
    <p id=\"welcomeBack\">Welcome, " . $row["employeefirstname"] . "! ID#: " . $empID . "!</p>
    <a href=\"index.php\">Log out</a>
</div>";
?>


