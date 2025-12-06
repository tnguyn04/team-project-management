<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';

    // Process the data (e.g., save to database, send email)
    // ...

    // Send a response back to the client
    echo "Thank you, " . htmlspecialchars($name) . "! Your email (" . htmlspecialchars($email) . ") has been received.";
} else {
    echo "Invalid request method.";
}
?>

<form id="myForm" method="post" action="process.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <input type="submit" value="Submit">
</form>
<div id="response"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#myForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission and page reload

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), // Get the action URL from the form
            data: $(this).serialize(),   // Serialize form data for submission
            success: function(response) {
                $('#response').html(response); // Display the response from PHP
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + error);
            }
        });
    });
});
</script>