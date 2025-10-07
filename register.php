<?php
// Simple input sanitization function
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name   = sanitize($_POST['name']);
    $email  = sanitize($_POST['email']);
    $course = sanitize($_POST['course']);

    if (!empty($name) && !empty($email) && !empty($course)) {
        // Store data in a file
        $file = fopen("registrations.txt", "a");
        fwrite($file, "Name: $name | Email: $email | Course: $course\n");
        fclose($file);

        // Success response
        echo "<h2>✅ Registration Successful!</h2>";
        echo "<p>Thank you, <strong>$name</strong>. Your registration has been recorded.</p>";
    } else {
        // Error response
        echo "<h2>❌ Registration Failed</h2>";
        echo "<p>Please fill all fields correctly.</p>";
    }
} else {
    // Display the registration form if not submitted
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Student Registration</title>
    </head>
    <body>
        <h2>Student Registration Form</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <label>Name:</label>
            <input type="text" name="name" required><br><br>

            <label>Email:</label>
            <input type="email" name="email" required><br><br>

            <label>Course:</label>
            <input type="text" name="course" required><br><br>

            <input type="submit" value="Register">
        </form>
    </body>
    </html>
    <?php
}
?>
