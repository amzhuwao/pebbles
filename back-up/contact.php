<?php
// Simple placeholder handler. Replace with real mailer (PHPMailer/SMTP) in production.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $errors = [];
    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email is required.';
    }
    if ($message === '') {
        $errors[] = 'Message is required.';
    }

    if (empty($errors)) {
        $safeBody = htmlspecialchars("Name: $name\nEmail: $email\nAge: $age\nMessage: $message", ENT_QUOTES, 'UTF-8');
        // TODO: send email via mail() or SMTP library.
        echo '<p>Thank you! We will be in touch within one school day.</p>';
        echo '<pre>' . $safeBody . '</pre>';
    } else {
        echo '<p>Please fix the following:</p><ul>';
        foreach ($errors as $error) {
            echo '<li>' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</li>';
        }
        echo '</ul><a href="/">Return to site</a>';
    }
} else {
    header('Location: /');
    exit;
}
