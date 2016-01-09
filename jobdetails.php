<!-- Start Main content -->

<?php
$jobID = test_input($_GET['jobid']);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$sqlQueryJob = "SELECT * FROM getjobdetails WHERE id = $jobID";
$result = $conn->query($sqlQueryJob);
?>

<?php
if ($result->num_rows != 1) {
    echo "Error retrieving data";
} else {
    $row = $result->fetch_assoc();
    ?>
    <?php include 'logintoapply.php'; ?>
    <?php
    echo "<div id=\"content\">
    <div class=\"title\">
        <h2>" . $row["title"] . "</h2>
        <span class=\"byline\">ID: " . $row["id"] . "</span>
    </div>
    <div id=\"listingDetails\">
        <table>
            <tr><td>
                    <strong>Post date:</strong> " . $row["postDate"] . ", " . $row["dayssince"] . " days ago<br />";
    if ($row["daysleft"] >= 0) {
        echo "<strong>Expires:</strong> In " . $row["daysleft"] . " days<br />";
    } else {
        echo "<strong>Expires:</strong> Does not expire.<br />";
    }

    echo "<strong>Location:</strong> " . $row["location"] . "<br />
                    <strong>Department:</strong> " . $row["department"] . "<br />
                    <br />
                    <strong>Description:</strong><br />
                    " . $row["desc"] . "<br />
                    <br />
                    <strong>Duties &amp; responsibilities:</strong><br />"
    . $row["duties"] . "<br />
                    <strong>Required skills:</strong>
                    <br />
                    " . $row["required"] . "
                    Job type: " . $row["type"] . "<br />
                    Rep ID: " . $row["empid"] . "<br /><br />
                    <br /><br />
                </td></tr>
        </table>
    </div>



</div>";
    // output data of each row
}
?>

<!-- End main content -->
