
<?php
session_start();

// Initialize variables
$errors = [];
$name = "";
$email = "";
$phone = "";
$gender = "";
$course = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and clean input
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $gender = $_POST["gender"] ?? "";
    $course = $_POST["course"] ?? "";

    // Validate name
    if ($name == "") {
        $errors["name"] = "Name is required.";
    } elseif (strlen($name) < 3) {
        $errors["name"] = "Name must be at least 3 characters.";
    }

    // Validate email
    if ($email == "") {
        $errors["email"] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format.";
    }

    // Validate phone
    if ($phone == "") {
        $errors["phone"] = "Phone number is required.";
    } elseif (!preg_match("/^[0-9]{9,15}$/", $phone)) {
        $errors["phone"] = "Phone must contain 9-15 digits.";
    }

    // Validate gender
    if (!in_array($gender, ["Male", "Female"])) {
        $errors["gender"] = "Please select your gender.";
    }

    // Validate course
    $validCourses = ["Computer Science", "Business", "English"];

    if (!in_array($course, $validCourses)) {
        $errors["course"] = "Please select a valid course.";
    }

    // If no errors, use PRG
    if (empty($errors)) {

        $_SESSION["success"] = "Student registered successfully!";

        $_SESSION["student"] = [
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "gender" => $gender,
            "course" => $course
        ];

        header("Location: student_registration.php");
        exit();
    }
}

// Get success message after redirect
$success = $_SESSION["success"] ?? "";
$student = $_SESSION["student"] ?? null;

unset($_SESSION["success"]);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
            padding: 30px;
        }

        .container {
            background: white;
            max-width: 500px;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        button {
            background: #2563eb;
            color: white;
            padding: 12px;
            border: none;
            width: 100%;
            cursor: pointer;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 12px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Student Registration</h2>

    <?php if ($success): ?>
        <div class="success">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <label>Full Name</label>
        <input type="text" name="name"
            value="<?= htmlspecialchars($name) ?>">
        <div class="error">
            <?= $errors["name"] ?? "" ?>
        </div>

        <label>Email</label>
        <input type="text" name="email"
            value="<?= htmlspecialchars($email) ?>">
        <div class="error">
            <?= $errors["email"] ?? "" ?>
        </div>

        <label>Phone Number</label>
        <input type="text" name="phone"
            value="<?= htmlspecialchars($phone) ?>">
        <div class="error">
            <?= $errors["phone"] ?? "" ?>
        </div>

        <label>Gender</label>
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
        <div class="error">
            <?= $errors["gender"] ?? "" ?>
        </div>

        <label>Course</label>
        <select name="course">
            <option value="">-- Select Course --</option>

            <?php foreach (["Computer Science", "Business", "English"] as $c): ?>
                <option value="<?= htmlspecialchars($c) ?>"
                    <?= $course == $c ? "selected" : "" ?>>
                    <?= htmlspecialchars($c) ?>
                </option>
            <?php endforeach; ?>

        </select>
        <div class="error">
            <?= $errors["course"] ?? "" ?>
        </div>

        <br>
        <button type="submit">Register Student</button>

    </form>

    <?php if ($student): ?>
        <hr>
        <h3>Last Registered Student</h3>
        <p>Name: <?= htmlspecialchars($student["name"]) ?></p>
        <p>Email: <?= htmlspecialchars($student["email"]) ?></p>
        <p>Phone: <?= htmlspecialchars($student["phone"]) ?></p>
        <p>Gender: <?= htmlspecialchars($student["gender"]) ?></p>
        <p>Course: <?= htmlspecialchars($student["course"]) ?></p>
    <?php endif; ?>

</div>

</body>
</html>
