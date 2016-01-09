<div id="sidebar">
    <div class="box2">

        <h2>Search</h2>
        <!--- By keyword -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <ul class="style2">
                <li><input name="keyword" type="text" />
                    <input type="submit" value="Go" /></li>
            </ul>
        </form>
        <?php
        // define variables and set to empty values
        $keyw = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $keyw = test_input($_POST["keyword"]);
        }
        /* echo $location; */

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
        <!--- End by keyword -->
        <!--- Start by location -->
        <br />
        <h3>Filter</h3>
        <h4>Location</h4>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <ul class="style2">
                <?php
                $sqlQueryLocs = "SELECT * FROM getLocations";
                try {
                    $result = $conn->query($sqlQueryLocs);
                } catch (Exception $e) {
                    echo "0 results to display.";
                }
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<li><input disabled=\"disabled\" name=\"location\" type=\"checkbox\" value=\"" . $row["City"] . "\" /> " . $row["City"] . " (" . $row["Count"] . ")</li>";
                    }
                }
                ?>
            </ul>
            <h4>Department</h4>
            <ul class="style2">
<?php
$sqlQueryDeps = "SELECT * FROM getDepartments";
$result = $conn->query($sqlQueryDeps);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<li><input disabled=\"disabled\" name=\"department\" type=\"checkbox\" value=\"" . $row["Name"] . "\" /> " . $row["Name"] . " (" . $row["Count"] . ")</li>";
    }
}
?>

            </ul>
            <br />
            <input type="submit" value="Submit" disabled="disabled" />
        </form>
<?php
/*
  // define variables and set to empty values
  $location = "";
  $department = "";

  //if ($_POST["location"])

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $location = test_input($_POST["location"]);
  $department = test_input($_POST["department"]);
  }
  echo $location;
 */
?>

    </div>
</div>