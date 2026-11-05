
<?php
$skills = [];
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $skills = $_POST["skills"] ?? [];

    if (empty($skills)) {
        $error = "Please select at least one skill.";
    }
}

$allSkills = ["PHP", "HTML", "CSS", "JavaScript", "Python"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab 4.6 - Sticky Checkbox</title>
</head>
<body>

<h2>Select Your Skills</h2>

<p style="color:red;">
    <?= htmlspecialchars($error) ?>
</p>

<form method="POST">

    <?php foreach ($allSkills as $skill): ?>

        <label>
            <input type="checkbox"
                name="skills[]"
                value="<?= htmlspecialchars($skill) ?>"
                <?= in_array($skill, $skills) ? "checked" : "" ?>>

            <?= htmlspecialchars($skill) ?>
        </label>

        <br>

    <?php endforeach; ?>

    <br>
    <button type="submit">Submit</button>

</form>

</body>
</html>
