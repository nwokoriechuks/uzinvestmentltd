<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form fields safely
    $name    = htmlspecialchars(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validate fields
    if (empty($name) || empty($email) || empty($message)) {
        echo "❌ Please fill in all fields.";
        exit;
    }

    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "❌ Invalid email format.";
        exit;
    }

    // Recipient email (change to your email address)
    $to      = "nwokoriechuma@gmail.com";
    $subject = "📩 New Contact Form Message from $name";

    // Email body
    $body = "You received a new message from your website:\n\n";
    $body .= "👤 Name: $name\n";
    $body .= "📧 Email: $email\n\n";
    $body .= "💬 Message:\n$message\n";

    // Headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "✅ Thank you, $name. Your message has been sent successfully!";
    } else {
        echo "❌ Sorry, there was a problem sending your message. Please try again later.";
    }
} else {
    echo "❌ Invalid request.";
}
