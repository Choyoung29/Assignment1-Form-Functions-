
<?php
$name = "";
$email = "";
$message = "";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Step 1: Get and clean input
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    // Step 2: Validate name
    if ($name == "") {
        $errors["name"] = "Name is required.";
    }

    // Step 3: Validate email using filter_input
    $filteredEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (!$filteredEmail) {
        $errors["email"] = "Please enter a valid email.";
    }

    // Step 4: Validate message
    if ($message == "") {
        $errors["message"] = "Message is required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab 4.8 - Contact Form</title>
</head>
<body>

<h2>User Contact Form</h2>

<form method="POST">

    Name:
    <input type="text" name="name"
        value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>">
    <p style="color:red;">
        <?= htmlspecialchars($errors["name"] ?? "") ?>
    </p>

    Email:
    <input type="text" name="email"
        value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>">
    <p style="color:red;">
        <?= htmlspecialchars($errors["email"] ?? "") ?>
    </p>

    Message:
    <textarea name="message"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></textarea>
    <p style="color:red;">
        <?= htmlspecialchars($errors["message"] ?? "") ?>
    </p>

    <button type="submit">Send Message</button>

</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)): ?>

    <h3>Contact Information Submitted Successfully!</h3>

    <p>Name: <?= htmlspecialchars($name) ?></p>
    <p>Email: <?= htmlspecialchars($email) ?></p>
    <p>Message: <?= htmlspecialchars($message) ?></p>

<?php endif; ?>

</body>
</html>
