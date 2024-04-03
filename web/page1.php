<?php
require '../options/config.php';

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

// Check if the form is submitted
if (isset($_POST["sub"])) {
    // Get user input
    $username = $_POST["username"];
    $password = $_POST["pswd"];

    // Step 2: Validate user credentials using parameterized queries
    $sql = "SELECT * FROM [user] WHERE name = ? AND password = ?";
    $params = array($username, $password);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt !== false) {
        // Check if the login is successful
        if (sqlsrv_has_rows($stmt)) {
            $userData = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $userId = $userData['UserID'];

                // Start a session and store user information
       	    session_start();
   	    $_SESSION['user_id'] = $userId;
            $cookieValue = md5(uniqid(rand(), true));

            // Set a session cookie in the HTTP headers with a 10-minute expiration
            $cookieName = "session_cookie";
            $expirationTime = time() + 600; // expires in 10 minutes
            setcookie($cookieName, $cookieValue, $expirationTime, "/");

           // Redirect to page2.php with the UserID as a parameter
            header("Location: page2.php?pageid=$userId");
         exit();
        } else {
            // Display an error message for unsuccessful login
            echo "Invalid username or password";
        }

        // Clean up resources
        sqlsrv_free_stmt($stmt);
    } else {
        // Display an error message for query execution failure
        echo "Error executing query: " . print_r(sqlsrv_errors(), true);
    }
}

// Clean up resources
sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyberia Bank Login</title>
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            padding: 10px;
            color: #fff;
            display: flex;
            align-items: center;
               justify-content: space-between; /* Align the list to the right */

        }
        header img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }
        header ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        header li {
            margin-left: 20px;
        }
        a{
        color:white;
        }
        h1 {
            font-family: 'Your Custom Font', Arial, sans-serif;
            text-align: center;
            margin: 30px 0;
        }
        p {
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-container {
            display: flex;
            justify-content: center;
        }
        .button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        p {
            text-align: center;
            font-size: 18px;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto 30px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Add some color and emphasis for specific text */
        p strong {
            color: #007BFF;
        }

        /* Add some margin to the button container */
        .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
                header {
            background-color: #333;
            padding: 10px;
            color: #fff;
            display: flex;
            justify-content: space-between; /* Align the list to the right */
            align-items: center;
        }

        header img {
            width: 100px;
            height: 50px;
            margin-right: 10px;
        }

        header ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        header li {
            margin-left: 20px;
        }
           .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .button {
          background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 15px 30px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 350px; /* Set the desired width for the buttons */
        }
        .button:hover {
            background-color: #0056b3;
        }
        
        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 300px;
        }
        label {
            font-size: 16px;
            margin-bottom: 10px;
        }
        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            font-size: 16px;
        }
        button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            margin-top: 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <img src="../OSTE.png" alt="Logo">
        <a href="index.php"> <img style="width:25px;height:25px;" src="./ico/undo.png" alt="back"></a>

        <ul>
   	     <li><a href="../index.php">Home</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </header>

    <h1>Greetings, Welcome to the Cyberia Bank !!! </h1>
    <h1>Insert Your Information</h1>
    <div class="button-container">
        <form method="post" action="">
        <label for="inputField">Your name?:*</label>
        <input type="text" id="inputField2" name="username" required>
        <label for="inputField2">Your password?:*</label>
        <input type="text" id="inputField" name="pswd" required>

        <button type="submit" name="sub">Submit</button>
        </form>
        <form method="post" action="">
        <button type="submit" name="clear">Clear History</button>
    </form>
    </div>
</body>
</html>





