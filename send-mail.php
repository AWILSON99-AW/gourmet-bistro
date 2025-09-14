<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if(empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: contact.html?status=error");
        exit;
    }

    $recipient = "aw291099@gmail.com";
    $subject = "New Contact Form Message from $name";
    $email_content = "Name: $name\nEmail: $email\n\nMessage:\n$message\n";
    $email_headers = "From: $name <$email>";

    if(mail($recipient, $subject, $email_content, $email_headers)){
        header("Location: contact.html?status=success");
    } else{
        header("Location: contact.html?status=error");
    }
} else{
    header("Location: contact.html");
}
?>
