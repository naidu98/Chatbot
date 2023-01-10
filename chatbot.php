<html>
<head>
  <title>My Chatbot</title>
  <style>
    /* Add your CSS styles here */
  </style>
</head>
<body>
  <h1>My Chatbot</h1>
  <form method="POST" action="chatbot.php">
    <input type="text" name="message">
    <input type="submit" value="Send">
  </form>
  <?php
  if (isset($_POST['message'])) {
    // Connect to the database
    $db = new mysqli("localhost", "user", "password", "database");
    // Escape the message to prevent SQL injection attacks
    $message = $db->real_escape_string($_POST['message']);
    // Insert the message into the database
    $query = "INSERT INTO messages (message) VALUES ('$message')";
    $db->query($query);
    // Get a response from the chatbot
    $query = "SELECT response FROM chatbot WHERE message = '$message'";
    $result = $db->query($query);
    if ($result->num_rows > 0) {
      // If the chatbot has a response for this message, use it
      $response = $result->fetch_object()->response;
    } else {
      // If the chatbot doesn't have a response, use a default message
      $response = "I'm sorry, I don't understand what you mean.";
    }
    // Display the response to the user
    echo $response;
  }
  ?>
</body>
</html>