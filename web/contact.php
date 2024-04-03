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

if((isset($_POST['your_name']) && $_POST['your_name'] != '') && (isset($_POST['your_email']) && $_POST['your_email'] != '')) {
    $yourName = $_POST['your_name'];
    $yourEmail = $_POST['your_email'];
    $yourPhone = $_POST['your_phone'];
    $comments = $_POST['comments'];

    // Email validation
    if (strpos($yourEmail, '@test.com') === false) {
        echo "Error: Only @test.com email addresses are allowed to submit.";
    } else {
        // Phone number validation
        if (!preg_match('/^\d{10}$/', $yourPhone)) {
            echo "Error: Phone number should be a 10-digit numeric value.";
        } else {
            $sql = "INSERT INTO contact_form (name, email, phone, comments) VALUES (?, ?, ?, ?)";
            $params = array($yourName, $yourEmail, $yourPhone, $comments);

            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt === false) {
                echo "Error inserting data: " . print_r(sqlsrv_errors(), true);
            } else {
                echo "Thank you! We will contact you soon";
            }
        }
    }
} else {
    echo "Please fill Name and Email";
}

sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #3f51b5;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../OSTE.png" alt="Logo" style="width: 100px; height: auto;">
        </div>
        <h1>Contact Us</h1>
    </header>
    <div class="container">
        <form action="submit.php" method="post">
            <label for="your_name">Name:</label><br>
            <input type="text" id="your_name" name="your_name" required><br>
            
            <label for="your_email">Email:</label><br>
            <input type="email" id="your_email" name="your_email" required><br>
            
            <label for="your_phone">Phone:</label><br>
            <input type="text" id="your_phone" name="your_phone"><br>
            
            <label for="comments">Comments:</label><br>
            <textarea id="comments" name="comments" required></textarea><br>
            
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>

       
