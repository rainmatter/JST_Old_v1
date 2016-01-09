<!-- Start Main content -->
<div id="content">
    <div class="title">
        <h2>New Job Posting</h2>
    </div>


    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?empid=$empID"); ?>">
        <table id="jptable">
            <tr>
                <td>Title:</td>
                <td><input name="title" type="text" size="25" /></td>
            </tr>
            <tr>
                <td>Description:</td>
                <td><textarea name="description" cols="50" rows="10"></textarea></td>
            </tr>
            <tr>
                <td>Duties &amp; responsibilities:</td>
                <td><textarea name="duties" cols="50" rows="10"></textarea></td>
            </tr>
            <tr>
                <td>Required Skills &amp; experience:</td>
                <td><textarea name="required" cols="50" rows="10"></textarea></td>
            </tr>
            <tr>
                <td><h3>Exp. Date</h3></td>
                <td></td>
            </tr>

            <tr>
                <td>Month: <select name="expmonth">
                        <?php
                        $months = 1;

                        while ($months <= 12) {
                            echo "<option>$months</option>";
                            $months++;
                        }
                        ?>
                    </select></td>
                <td>Day: <select name="expday">
                        <?php
                        $days = 1;
                        while ($days <= 31) {
                            echo "<option>$days</option>";
                            $days++;
                        }
                        ?>
                    </select>
                    Year: <select name="expyear">
                        <?php
                        $years = 2015;
                        while ($years <= 2020) {
                            echo "<option>$years</option>";
                            $years++;
                        }
                        echo "test";
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Job type Description:</td>
                <td><input name="type" type="text" size="15" value="Full-time, Salary" /></td>
            </tr>
            <tr>
                <td>Department/Location: </td>
                <td><select name="deploc">
                        <?php
                        $sqlQueryDepOpts = "SELECT * FROM getDepartmentOptions";
                        $result = $conn->query($sqlQueryDepOpts);
                        //echo "test" . $result->num_rows;
                        ?>
                        <?php
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo $row["id"];
                                echo "<!-- Start listing loop -->
                            <option value = " . $row["id"] . ">" . $row["id"] . " - " . $row["name"] . " - " . $row["city"] . "</option>
                            <!-- End listing loop -->";
                                $count++;
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </select></td>
            </tr>


        </table>


        <br />
        <input name="Submit1" type="submit" value="Submit New Job" />
        <?php
        // define variables and set to empty values
        $titleErr = $descriptionErr = $dutiesErr = $requiredErr = "";
        $title = $description = $duties = $required = $type = $deploc = "";
        $expmonth = $expday = $expyear = 0;

        echo "<p id=\"error\">";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["title"])) {
                $titleErr = "<br />*Name is required";
                echo $titleErr;
            } else {
                $title = test_input($_POST["title"]);
                $title = add_quotes($_POST["title"]);
            }
            if (empty($_POST["description"])) {
                $descriptionErr = "<br />*Description is required";
                echo $descriptionErr;
            } else {
                $description = test_input($_POST["description"]);
            }
            if (empty($_POST["duties"])) {
                $dutiesErr = "<br />*Duties is required.";
                echo $dutiesErr;
            } else {
                $duties = test_input($_POST["duties"]);
            }
            if (empty($_POST["required"])) {
                $requiredErr = "<br />*Required experience is required.";
                echo $requiredErr;
            } else {
                $required = test_input($_POST["required"]);
            }
            if (!(empty($_POST["title"]) || empty($_POST["description"]) || empty($_POST["duties"]) || empty($_POST["required"]))) {
                //Add quotations
                $title = add_quotes($_POST["title"]);
                $description = add_quotes($_POST["description"]);
                $duties = add_quotes($_POST["duties"]);
                $required = add_quotes($_POST["required"]);
                $expyear = test_input($_POST["expyear"]);
                $expday = test_input($_POST["expday"]);
                $expmonth = test_input($_POST["expmonth"]);
                $expDate = $expyear . "-" . $expmonth . "-" . $expday;
                $expDate = add_quotes($expDate);
                $type = add_quotes($_POST["type"]);
                $deploc = test_input($_POST["deploc"]);


                $expDate = $expyear . "-" . $expmonth . "-" . $expday;

                $sqlQueryInsertJob = "INSERT INTO joblisting VALUES "
                        . "((getLastJobID() + 1), curdate(), DATE(\"$expDate\"), curtime(), "
                        . "$title, $description, $duties, $required, "
                        . "$type, $deploc, $empID);";
                //echo $sqlQueryInsertJob;



                if ($conn->query($sqlQueryInsertJob) === TRUE) {
                    echo "<h3>Job added Successfully!</h3>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            /*
              if (empty($_POST["deploc"])) {
              $deplocErr = "Required experience is required";
              } else {
              $required = test_input($_POST["required"]);
              } */
        }

        function add_quotes($data) {
            return "\"" . $data . "\"";
        }

        echo "</p>";
        /*
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $title = test_input($_POST["title"]);
          $description = test_input($_POST["description"]);
          $duties = test_input($_POST["duties"]);
          $required = test_input($_POST["required"]);
          $expmonth = $_POST["expmonth"];
          $expday = $_POST["expday"];
          $expyear = $_POST["expyear"];
          $type = test_input($_POST["type"]);
          $deploc = test_input($_POST["deploc"]);
          //Add quotations
          $title = add_quotes($_POST["title"]);
          $description = add_quotes($_POST["description"]);
          $duties = add_quotes($_POST["duties"]);
          $required = add_quotes($_POST["required"]);
          $expDate = $expyear."-".$expmonth."-".$expday;
          $expDate = add_quotes($_POST[$expDate]);
          $type = add_quotes($_POST["type"]);
          } */




        //$duties = iconv('utf-8', 'ascii//TRANSLIT', $duties);
        /*
          echo "<br><br>".$title;
          echo "<br>".$description;
          echo "<br>".$duties;
          echo "<br>".$required;
          echo "<br>".$expmonth;
          echo "<br>".$expday;
          echo "<br>".$expyear;
          echo "<br>".$type;
          echo "<br>".$deploc;

         */
        ?>
        <?php
        $conn->close();
        ?>
</div>
<!-- End main content -->
