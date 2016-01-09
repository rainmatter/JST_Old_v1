<?php
$jobID = test_input($_GET['jobid']);
?>
<?php
$sqlQueryInsertToCart = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sqlQueryInsertToCart = "INSERT INTO jobcart VALUES "
            . "((getLastJobCartID() + 1), curdate(), $appID, $jobID);";
}
?>


<div id="content">
    <div class="title">
        <?php
        if ($conn->query($sqlQueryInsertToCart) === TRUE) {
            echo "<h2>Job Added to Cart!</h2>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        ?>
    </div>
    <div id="listingDetails">
        <a href="viewcart.php?appid=<?php echo $appID; ?>">View Cart</a>
        <table>

        </table>
    </div>

    <?php
    $conn->close();
    ?>

</div>
