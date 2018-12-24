<?php

require 'include/env.php';

// Parse form data
$submit = $_POST['submit'];
$message = '';

if($submit == "Create")
{
    // Sanitize Input
    $term = mysqli_real_escape_string($db, $_POST['term']);
    $term = trim($term);
    $definition = mysqli_real_escape_string($db, $_POST['definition']);
    $definition = trim($definition);
    
    // If input is valid, create the flashcard record
    if(!empty($term) && !empty($definition))
    {
        // Insert Query
        $sql = "INSERT INTO flashcards (term, definition)
                VALUES ('$term', '$definition')";

        // Try Query
        if (!mysqli_query($db, $sql)) {
            die('Error: ' . mysqli_error($db));
        }

        // Set Success Message, remove sticky form values
        $message = '<p class="message">One Record Created</p>';
        $term = '';
        $definition = '';
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
    echo "term: " . $_POST['term'];
    echo '<br />';
    echo "definition: " . $_POST['definition'];
    echo '<br />';
    echo "submit: " . $_POST['submit'];
    echo '<br />';
}

// New Card Form
$form = '
    <form action="/add.php" method="POST" >
        <label for="term">Term</label>
        <input type="text" name="term" value="' . $term . '" />
        <label for="definition">Definition</label>
        <input type="text" name="definition" value="' . $definition . '" />
        <input class="button" type="submit" name="submit" value="Create"></button>
    </form>
';
echo $form;

$db->close();

?>