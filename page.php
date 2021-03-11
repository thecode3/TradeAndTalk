<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $welcomeMessage = "Welcome to the member's area, " . $_SESSION['username'] . "!";
} else {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Index page</title>  
</head>
<body>
<?
    if(!empty($welcomeMessage)) echo $welcomeMessage;
?>
 Index page
</body>
</html>
