<?php

require 'include/env.php';

// Parse form data
$submit = $_POST['submit'];
$message = '';

if($submit == "Create")
{
    // Sanitize Input
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $name = trim($name);
    
    // If input is valid, create the flashcard record
    if(!empty($name))
    {
        // Insert Query
        $sql = "INSERT INTO groups (name)
                VALUES ('$name')";

        // Try Query
        if (!mysqli_query($db, $sql)) {
            die('Error: ' . mysqli_error($db));
        }

        // Set Success Message, remove sticky form values
        $message = '<p class="message">One Record Created</p>';
        $name = '';
    }
    else {
        $message = '<p class="message">Fields may not be empty</p>';
    }
}

// HTML Page Header
$header = <<<EOF
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>title</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
EOF;
echo $header;

include 'include/menu.php';

echo $message;

// Debugger
if($debug)
{
    echo "name: " . $_POST['name'];
    echo '<br />';
    echo "submit: " . $_POST['submit'];
    echo '<br />';
}

// New Card Form
$form = '
    <form action="/addgroup.php" method="POST" >
        <label for="name">Name</label>
        <input type="text" name="name" value="' . $name . '" />
        <input class="button" type="submit" name="submit" value="Create"></button>
    </form>
';
echo $form;

// HTML Footers
$footer = <<<EOF
</body>
</html>
EOF;
echo $footer;

// close db connections
require 'include/end.php';
?>