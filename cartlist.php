
<?php
$sqlQueryGetCart = "";
?>



<!-- Start Main content -->
<div id="content">
    <div class="title">
        <h2>Job Cart</h2>
    </div>
<?php
$sqlQueryGetCart = "SELECT * FROM getcart WHERE appid=$appID";
$result = $conn->query($sqlQueryGetCart);

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
                                <td><span id=\"jobTitleLink\"><a href=\"apply.php?appid=$appID&jobid=" . $row["jobid"] . "\">" . $row["title"] . "</a> - " . $row["department"] . " - " . $row["location"] . "</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <span id=\"depLoc\"></span>
                                </td>
                            </tr>


                            <tr>
                                <td></td>
                                <td><span id=\"datePost\">Date added: " . $row["dateadded"] . "</span></td>
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