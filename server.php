<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect post data from form
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $contactMethod = $_POST["contactMethod"];
    $services = [];
    if (isset($_POST["service1"])) $services[] = trim($_POST["service1"]);
    if (isset($_POST["service2"])) $services[] = trim($_POST["service2"]);
    if (isset($_POST["service3"])) $services[] = trim($_POST["service3"]);
    $message = trim($_POST["message"]);

    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Contact Method: $contactMethod\n";
    $email_content .= "Services Interested: " . implode(", ", $services) . "\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $email_headers = "From: $name <$email>";

    // Send the email
    $to = 'sajal.sarker26@gamil.com'; // << UPDATE WITH YOUR EMAIL ADDRESS
    $subject = 'New contact from ' . $name;
    if (mail($to, $subject, $email_content, $email_headers)) {
        // Redirect to a thank-you page
        header("Location: thank-you.php");
        exit;
    } else {
        // Handle error
        echo 'Oops! Something went wrong and we couldn\'t send your message.';
    }
}
?>



