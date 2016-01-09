
<?php
$sqlQueryGetCompleted = "";
?>



<!-- Start Main content -->
<div id="content">
    <div class="title">
        <h2>Your completed applications</h2>
    </div>
<?php
$sqlQueryGetCompleted = "SELECT * FROM getapps WHERE appid=$appID";
$result = $conn->query($sqlQueryGetCompleted);

if ($result->num_rows > 0) {
    // output data of each row
    $count = 1;
    while ($row = $result->fetch_assoc()) {
        $colornum = $count % 2;
        echo "<!-- Start listing loop -->
                    <div id=\"jobListing\">
                        <table class=\"jobListingTable$colornum\" style=\"width: 100%\">
                            <tr>
                                <td id=\"listingNo\">$count. </td>
                                <td><span id=\"jobTitleLink\"><a href=\"viewjobloggedin.php?appid=$appID&jobid=" . $row["jobid"] . "\">" . $row["title"] . "</a> - " . $row["department"] . " - " . $row["location"] . "</span></td>
                                  <td> Date applied: " . $row["appdate"] . "</td>
</tr>
                            <tr>
                                <td></td>
                                <td>
                                    <span id=\"depLoc\"></span>
                                </td>
                                <td></td>
                            </tr>


                            <tr>
                                <td></td>
                                <td><span id=\"datePost\">Date added: " . $row["postDate"] . "</span></td>
                            </tr>
                        </table>
                    </div>
		<!-- End listing loop -->";
        $count++;
    }
} else {
    echo "0 results";
}
$conn->close();
?>



</div>
<!-- End main content -->