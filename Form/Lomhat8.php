
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"] ?? "");

    if ($name != "") {
        $_SESSION["success"] = "Form submitted successfully!";
    } else {
        $_SESSION["error"] = "Name is required.";
    }

    header("Location: lab47.php");
    exit();
}

$success = $_SESSION["success"] ?? "";
$error = $_SESSION["error"] ?? "";

unset($_SESSION["success"]);
unset($_SESSION["error"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab 4.7 - PRG Pattern</title>
</head>
<body>

<h2>PRG Pattern Form</h2>

<p style="color:green;">
    <?= htmlspecialchars($success) ?>
</p>

<p style="color:red;">
    <?= htmlspecialchars($error) ?>
</p>

<form method="POST">

    Name:
    <input type="text" name="name">

    <button type="submit">Submit</button>

</form>

</body>
</html>
