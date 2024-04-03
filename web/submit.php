<?php
require_once '../options/config.php'; // Include your configuration file

// Step 1: Connect to SQL Server
$connectionOptions = array(
    "Database" => $dbname,
    "Uid" => $username,
    "PWD" => $password,
    "Driver" => "{ODBC Driver 17 for SQL Server}"
);

$conn = sqlsrv_connect($servername, $connectionOptions);

if (!$conn) {
    die("Connection failed. Details: " . print_r(sqlsrv_errors(), true));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
</head>
<body>
    <h1>Contact Form Submission</h1>
    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if name, email, and phone are provided
        if (isset($_POST['your_name']) && $_POST['your_name'] != '' && isset($_POST['your_email']) && $_POST['your_email'] != '' && isset($_POST['your_phone']) && $_POST['your_phone'] != '') {
            // Retrieve form data
            $name = $_POST['your_name'];
            $email = $_POST['your_email'];
            $phone = $_POST['your_phone'];
            $comments = $_POST['comments'];

            // Email validation
            if (strpos($email, '@test.com') === false) {
                echo "<p>Error: Only @test.com email addresses are allowed to submit.</p>";
            } else {
                // Phone number validation
                if (!preg_match('/^\d{10}$/', $phone)) {
                    echo "<p>Error: Phone number should be a 10-digit numeric value.</p>";
                } else {
                    // Insert data into database
                    $sql = "INSERT INTO contact_form (name, email, phone, comments) VALUES (?, ?, ?, ?)";
                    $params = array($name, $email, $phone, $comments);
                    $stmt = sqlsrv_query($conn, $sql, $params);

                    if ($stmt === false) {
                        echo "<p>Error inserting data into the database: " . print_r(sqlsrv_errors(), true) . "</p>";
                    } else {
                        echo "<p>Thank you, $name, for your submission!</p>";
                        echo "<p>We will contact you soon at $email regarding your message: \"$comments\"</p>";
                        echo "<p>Your phone number: $phone</p>";
                    }
                }
            }
        } else {
            // If any required field is missing
            echo "<p>Please fill out all the required fields: Name, Email, and Phone.</p>";
        }
    } else {
        // If form is not submitted
        echo "<p>Form submission failed. Please try again.</p>";
    }
    ?>
</body>
</html>
