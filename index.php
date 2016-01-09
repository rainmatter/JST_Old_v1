<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Retention 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20140221

-->
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CareerSearch</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="http://fonts.googleapis.com/css?family=Karla:400,700" rel="stylesheet" />
        <link href="default.css" rel="stylesheet" type="text/css" media="all" />
        <link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
        <!--[if IE 6]>
        <link href="default_ie6.css" rel="stylesheet" type="text/css" />
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">

            <?php include 'connectdb.php'; ?>

            <?php include 'logoheader.php'; ?>
            <?php include 'notloggedmenu.php'; ?>
            <div id="page" class="container">	
                <?php include 'searchsidebar.php'; ?>


                <!-- Start Main content -->
                <div id="content">
                    <div class="title">
                        <h2>Job Listings</h2>
                        <span class="byline">
                            <?php
                            $sqlQuery = "CALL SearchJobListings('%" . $keyw . "%')";
                            //echo $sqlQuery;
                            $result = $conn->query($sqlQuery);
                            $numResults = $result->num_rows;
                            IF (strlen($keyw) > 0)
                                echo "Keyword: \"" . $keyw . "\", ";
                            ?><?php echo $numResults; ?> results</span>
                    </div>
                    <?php
                    if ($result->num_rows > 0) {
                        // output data of each row
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            $colornum = $count % 2;
                            $jobDesc = substr($row["Description"], 0, min(strlen($row["Description"]), 250));
                            if (strlen($row["Description"]) > 250) {
                                $jobDesc .= "...";
                            }
                            echo "<!-- Start listing loop -->
                    <div id=\"jobListing\">
                        <table class=\"jobListingTable$colornum\" style=\"width: 100%\">
                            <tr>
                                <td id=\"listingNo\">$count. </td>
                                <td><span id=\"jobTitleLink\"><a href=\"viewjob.php?jobid=" . $row["id"] . "\">" . $row["Title"] . "</a> - " . $row["Department"] . " - " . $row["Location"] . "</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <span id=\"depLoc\"></span>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <span id=\"jobDescription\">" . $jobDesc . "</span>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><span id=\"datePost\">Date posted: " . $row["Date"] . "</span></td>
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
            </div>
        </div>

        <div id="copyright" class="container">
            <p><a href="CareerSiteDBModel.pdf">CareerSiteDBModel</a></p>
            <p>&copy; August 2015. All rights reserved. | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>.</p>
        </div>
    </body>
</html>
