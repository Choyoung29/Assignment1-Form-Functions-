
<?php
$name = "";
$gender = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"] ?? "");
    $gender = $_POST["gender"] ?? "";

    if ($name == "" || $gender == "") {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab 4.5 - Sticky Form</title>
</head>
<body>

<h2>Sticky Text Field and Select Dropdown</h2>

<p style="color:red;">
    <?= htmlspecialchars($error) ?>
</p>

<form method="POST">

    Name:
    <input type="text" name="name"
        value="<?= htmlspecialchars($name) ?>">

    <br><br>

    Gender:
    <select name="gender">
        <option value="">-- Select Gender --</option>

        <option value="Male"
            <?= $gender == "Male" ? "selected" : "" ?>>
            Male
        </option>

        <option value="Female"
            <?= $gender == "Female" ? "selected" : "" ?>>
            Female
        </option>
    </select>

    <br><br>

    <button type="submit">Submit</button>
</form>

</body>
</html>
