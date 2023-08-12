<?php
session_start();
$pdo = require "database.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST["name"])) {
        $errors[] = "Name is required";
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }

    if (strlen($_POST['password']) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }

    if (!preg_match("/[a-z]/i", $_POST["password"])) {
        $errors[] = "Password must contain at least 1 letter";
    }

    if (!preg_match("/[0-9]/i", $_POST["password"])) {
        $errors[] = "Password must contain at least 1 number";
    }

    if ($_POST['password'] !== $_POST['password_confirmation']) {
        $errors[] = "Passwords do not match";
    }

    if (empty($errors)) {
        try {
            $checkEmailQuery = "SELECT id FROM user WHERE email = ?";
            $checkEmailStmt = $pdo->prepare($checkEmailQuery);
            $checkEmailStmt->execute([$_POST['email']]);
            $checkEmailResult = $checkEmailStmt->rowCount();
            if ($checkEmailResult > 0) {
                $errors[] = "Email is already taken";
            } else {
                $passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $insertQuery = "INSERT INTO user (name, email, password_hash) VALUES (?, ?, ?)";
                $insertStmt = $pdo->prepare($insertQuery);
                $insertStmt->execute([$_POST['name'], $_POST['email'], $passwordHash]);

                $_SESSION['signup_success'] = "Sign-Up Successful";
            }
        } catch (PDOException $e) {
            $errors[] = "Error signing up: " . $e->getMessage();
        }
    }

    $_SESSION['signup_errors'] = $errors;

    header("Location: index.php");
    exit();
}
?>
