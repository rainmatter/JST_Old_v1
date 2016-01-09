<?php
$jobID = test_input($_GET['jobid']);

$completed = FALSE;
$sqlQueryGetCart = "SELECT * FROM getappbasicinfo WHERE appid=$appID";
$result = $conn->query($sqlQueryGetCart);

if ($result->num_rows == 0) {
    echo "No applicant information.";
}
$row = $result->fetch_assoc()
?>
<!-- Start Main content -->
<div id="content">

    <div class="title">
        <h2>Application</h2>
    </div>

    <div id="jobListing">
        <table class="jobListingTable1" style="width: 100%">
            <tr>

                <td><span id="jobTitleLink"><a href="#">Software Engineer</a> - IT - Chicago, IL</span></td>
            </tr>

        </table>
    </div>
    <h3>Personal Information</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?jobid=$jobID&appid=$appID"); ?>">
        <table id="apptable">
            <tr>
                <td>First name:</td>
                <td><input name="fname" type="text" size="15" value="<?php echo $row["fname"]; ?>" /></td>
            </tr>
            <tr>
                <td>Middle name:</td>
                <td><input name="mname" type="text" size="10" value="<?php echo $row["mname"]; ?>" /></td>
            </tr>

            <tr>
                <td>Last name:</td>
                <td><input name="lname" type="text" size="15" value="<?php echo $row["lname"]; ?>" /></td>
            </tr>
            <tr>
                <td>SSN:</td>
                <td><input name="ssn" type="text" size="11" value="<?php echo $row["ssn"]; ?>" /></td>
            </tr>
            <tr>
                <td>Birth date:</td>
                <td><input name="bdate" type="text" size="10" maxlength="10" value="<?php echo $row["bdate"]; ?>" /></td>
            </tr>
        </table>
        <h3>Address</h3>
        <table id="apptable">
            <tr>
                <td>Street:</td>
                <td><input name="street" type="text" size="20" value="<?php echo $row["street"]; ?>" /></td>
            </tr>
            <tr>
                <td>City:</td>
                <td><input name="city" type="text" size="15" value="<?php echo $row["city"]; ?>" /> 
                    State: <input name="state" type="text" size="15" maxlength="15" value="<?php echo $row["state"]; ?>" /></td>
            </tr>
            <tr>
                <td>Zip code:</td>
                <td><input name="zip" type="text" size="9" value="<?php echo $row["zip"]; ?>" /></td>
            </tr>
        </table>
        <br />
        <h3 id="apph3">Work Experience</h3>
        <h4>Job 1</h4>
        <table id="apptable">
            <tr>
                <td>Company name:</td>
                <td><input name="company" type="text" size="20" value="<?php echo $row["company"]; ?>" /></td>
            </tr>
            <tr>
                <td>Start date:</td>
                <td><input name="start" type="text" size="10" maxlength="10" value="<?php echo $row["start"]; ?>" /> 
                    End date: <input name="end" type="text" size="10" maxlength="10" value="<?php echo $row["end"]; ?>" /></td>
            </tr>
        </table>

        <br />
        <h3 id="apph3">Resume &amp; Cover Letter</h3>
        <table id="apptable">
            <tr>
                <td>Upload resume(optional):</td>
                <td><input name="ResumeFile" type="file" disabled="disabled" /></td>
            </tr>
            <tr>
                <td>Input resume (optional):</td>
                <td><textarea name="resume" cols="50" rows="15"></textarea></td>
            </tr>
            <tr>
                <td>Upload cover letter (optional):</td>
                <td><input name="CoverLetter" type="file" disabled="disabled" /></td>
            </tr>
            <tr>
                <td>Input cover letter (optional):</td>
                <td><textarea name="coverletter" cols="50" rows="15"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input name="Submit1" type="submit" value="Submit Application" /></td>
            </tr>

        </table>

        <?php
        $resume = $coverletter = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $resume = test_input($_POST["resume"]);
            $coverletter = test_input($_POST["coverletter"]);
            $resume = add_quotes($resume);
            $coverletter = add_quotes($coverletter);
            if (!(empty($_POST["resume"]) || empty($_POST["coverletter"]))) {
                $sqlQueryAddResume = "INSERT INTO `resume` VALUES (getLastResumeID() + 1, $resume, NULL)";
                $sqlQueryAddCoverLetter = "INSERT INTO coverletter VALUES (getLastCoverLetterID() + 1, $coverletter, NULL)";
                $sqlQueryApply = "INSERT INTO application VALUES "
                        . "((getLastAppID() + 1), curdate(), $appID, $jobID, getLastResumeID(), getLastCoverLetterID())";

                //echo $sqlQueryApply;
                if ($conn->query($sqlQueryAddResume) === TRUE && $conn->query($sqlQueryAddCoverLetter) === TRUE && $conn->query($sqlQueryApply) === TRUE) {
                    echo "<h3>Application Successful!</h3>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }

        function add_quotes($data) {
            return "\"" . $data . "\"";
        }
        ?>
        <?php
        $conn->close();
        ?>

        <br />

</div>


<!-- End main content -->
