<?php
// Function to validate user permissions
function isValidUser($loggedInUserId, $requestedUserId)
{
    return $loggedInUserId == $requestedUserId;
}

session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not authenticated
    header("Location: page1.php"); // Adjust the login page URL
    exit();
}

// Check if the user is authenticated (logged in)

// Check if the pageid is set in the URL
if (isset($_GET['pageid'])) {
    $userId = $_GET['pageid'];

    // Validate user permissions before proceeding
    if (isValidUser($_SESSION['user_id'], $userId)) {
        require '../options/config.php';

        // Connect to SQL Server
        $conn = sqlsrv_connect($servername, $connectionOptions);

        if (!$conn) {
            die("Connection failed. Details: " . print_r(sqlsrv_errors(), true));
        }

        // Fetch and display data for the specific UserID
        $sql = "SELECT UserID, UserName, AccountNumber, Balance, Email, BranchLocation FROM cyberiabank WHERE UserID = ?";
        $params = array($userId);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt !== false) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

            if ($row) {
                ?>
                <!DOCTYPE html>
                <html lang='en'>

                <head>
                    <title>User Details</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f5f5f5;
                        }

                        header {
                            background-color: #333;
                            color: white;
                            padding: 10px;
                            text-align: center;
                        }

                        img {
                            margin-right: 10px;
                        }

                        ul {
                            list-style-type: none;
                            margin: 0;
                            padding: 0;
                            overflow: hidden;
                        }

                        li {
                            display: inline;
                            margin-right: 20px;
                        }

                        .content-container {
                            margin: 20px;
                        }

                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-top: 20px;
                        }

                        th, td {
                            border: 1px solid #ddd;
                            padding: 8px;
                            text-align: left;
                        }

                        th {
                            background-color: #333;
                            color: white;
                        }

                        h2 {
                            color: #333;
                        }

                        p {
                            color: #666;
                        }
                    </style>
                </head>

                <body>
                    <header>
                        <img src="../OSTE.png" alt="Logo">
                        <a href="index.php"> <img style="width:15px;height:15px;" src="./ico/undo.png" alt="back"></a>

                        <ul>
                            <li><a href="../index.php">Home</a></li>
                        </ul>
                    </header>

                    <div class='content-container'>
                        <h2>User Details</h2>
                        <table>
                            <tr>
                                <th>User ID</th>
                                <th>User Name</th>
                                <th>Account Number</th>
                                <th>Balance</th>
                                <th>Email</th>
                                <th>Branch Location</th>
                            </tr>
                            <tr>
                                <td><?php echo $row['UserID']; ?></td>
                                <td><?php echo $row['UserName']; ?></td>
                                <td><?php echo $row['AccountNumber']; ?></td>
                                <td><?php echo $row['Balance']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['BranchLocation']; ?></td>
                            </tr>
                        </table>

                        <p>Welcome to Cyberia Bank! We are committed to providing top-notch banking services to our valued customers.</p>
                    </div>

                </body>

                </html>
                <?php
            } else {
                // Handle case where UserID is not found
                echo "User not found";
            }

            // Clean up resources
            sqlsrv_free_stmt($stmt);
        } else {
            // Display an error message for query execution failure
            echo "Error executing query: " . print_r(sqlsrv_errors(), true);
        }

        // Clean up resources
        sqlsrv_close($conn);
    } else {
        // User does not have permission to access this data
        echo "You do not have permission to access this data.";
    }
} else {
    // Handle missing pageid
    echo "Pageid not set";
}
?>
