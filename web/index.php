
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="google-site-verification" content="34wOCPeSUvPzWAd6PjBImav-hV4ppzQZM2cpUGq5cvM" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyberia Web Application</title>
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
    </style>
</head>
<body>
    <header>
        <img src="../OSTE.png" alt="Logo">
        <ul>
   	     <li><a href="index.php">Home</a></li>
            <li><a href="page1.php">Login</a></li>
        </ul>
    </header>

    <h1>Cyberia bank Web Application</h1>

 <p>

      <img src="../OSTE.png" alt="Logo" style="width: 100px; height: auto;">

	Welcome to Cyberia Bank, where your financial security is our top priority. At Cyberia Bank, we strive to provide innovative banking solutions tailored to meet your needs.

	</br>With Cyberia Bank, you can enjoy a wide range of services designed to make your banking experience seamless and convenient. Whether you're looking to manage your accounts, transfer funds, pay bills, or apply for loans, our user-friendly online platform and mobile app give you access to your finances anytime, anywhere.

	</br>At Cyberia Bank, we understand the importance of safeguarding your personal information. That's why we employ the latest encryption technologies and stringent security measures to protect your data and ensure peace of mind.

	</br>Our team of dedicated professionals is here to assist you every step of the way. Whether you have questions about your account or need assistance with a transaction, our friendly customer support representatives are available to provide prompt and personalized assistance.

	</br>Thank you for choosing Cyberia Bank for your banking needs. We look forward to serving you and helping you achieve your financial goals. Welcome to a brighter banking experience with Cyberia Bank.
    </p>
    <div class="btn-container">
        <button class="button" onclick="location.href='index.php';">Go to Home</button>
        <button class="button" onclick="location.href='page1.php';">Go to Login</button>
    </div>

    <!-- You can add more content as needed -->

</body>
</html>
