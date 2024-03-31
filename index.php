<!DOCTYPE html>
<html>
<head>
  <title>EventCalendarizer</title>
  <style>
    body {
        background-color: #112240; /* Dark blue background */
        color: #ffffff; /* White text */
        font-family: Arial, sans-serif;
        text-align: center;
    }

    h1 {
        margin-bottom: 20px;
    }

    p {
        margin-bottom: 20px;
        font-size: 16px;
    }

    .example {
        margin-bottom: 10px;
        font-style: italic;
    }

    textarea {
        width: 90%;
        max-width: 500px;
        padding: 10px;
        margin-bottom: 20px;
        background-color: rgba(255, 255, 255, 0.1); /* Semi-transparent white background */
        border: none;
        border-radius: 5px; /* Rounded corners */
        color: #ffffff; /* White text */
    }

    input[type="submit"] {
        background-color: #1a78c2; /* Slightly lighter blue */
        color: #ffffff; /* White text */
        padding: 10px 20px;
        border: 2px solid #ffffff; /* White border */
        border-radius: 20px; /* Rounded corners */
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s, border-color 0.3s, color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #135e8f; /* Darker blue on hover */
        border-color: #ffffff; /* White border on hover */
        color: #ffffff; /* White text on hover */
    }

    @media (max-width: 600px) {
        body {
            padding: 10px;
        }
    }
  </style>
</head>
<body>
  <h1>EventCalendarizer</h1>
  <p>Enter each event on a new line in the format "MMM DD-MMM DD: Event Title". Use three-letter month abbreviations.</p>
  <div class="example">
    <p>Example:</p>
    <p>Dec 28-Dec 29: Holiday Trip</p>
    <p>Apr 24-Apr 29: Conference</p>
  </div>
  <form method="post" action="generate_ics.php">
    <textarea name="events" rows="10" placeholder="e.g., Dec 28-Dec 29: Holiday Trip\nApr 24-Apr 29: Conference"></textarea><br>
    <input type="submit" value="Generate iCalendar">
  </form>
  <?php
  // Display error message if present
  if (isset($_GET['error'])) {
      echo '<span id="error_message" style="color: #ff0000;">' . htmlspecialchars($_GET['error']) . '</span>';
  }
  ?>
  <script>
    /* (Previous JavaScript remains unchanged) */
  </script>
</body>
</html>
