
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Building a Dynamic Form with PHP</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <h1>Building a Dynamic Form with PHP</h1>
    <p>Johnathon Askey</p>
    <p><?php echo date("F j, Y"); ?></p>

    <?php
    // Check whether the form was submitted using POST.
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Store the submitted values and trim extra whitespace.
        $name = trim($_POST["name"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $message = trim($_POST["message"] ?? "");

        // Sanitize the email address.
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        // Check for empty fields and a valid email address.
        if ($name === "" || $email === "" || $message === "") {
            $notice = "Please complete all fields.";
            $class = "error";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $notice = "Please enter a valid email address.";
            $class = "error";
        } else {
            // Create a success message when the inputs are valid.
            $notice = "Thank you for your message!";
            $class = "success";
        }

        // Display the appropriate confirmation or error message.
        echo '<div class="confirmation ' . $class . '">';
        echo '<p>' . htmlspecialchars($notice, ENT_QUOTES, "UTF-8") . '</p>';

        // Display the submitted details safely.
        if ($class === "success") {
            echo '<p><strong>Name:</strong> ' . htmlspecialchars($name, ENT_QUOTES, "UTF-8") . '</p>';
            echo '<p><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, "UTF-8") . '</p>';
            echo '<p><strong>Message:</strong> ' . nl2br(htmlspecialchars($message, ENT_QUOTES, "UTF-8")) . '</p>';
        }

        echo '</div>';

    } else {
        // Show an error if someone opens this page without submitting the form.
        echo '<div class="confirmation error">Please submit the form first.</div>';
    }
    ?>
</body>
</html>
