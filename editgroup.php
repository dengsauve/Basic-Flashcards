<?php

require 'include/env.php';
$pageTitle = "Edit Flashcard Groups";

// get id of editable card
$id = mysqli_real_escape_string($db, $_GET['id']);
// if none is passed, try to get from $_POST data
if(empty($id)) $id = mysqli_real_escape_string($db, $_POST['id']);

if(!empty($id))
{
    // if posted submission
    if($_POST['submit'] == 'Update')
    {
        // Sanitize Input
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $name = trim($name);

        // If input is valid, create the flashcard record
        if(!empty($name))
        {
            // Insert Query
            $sql = "UPDATE groups 
                        SET `name` = '$name'
                        WHERE id = $id";

            // Try Query
            if (!mysqli_query($db, $sql)) {
                die('Error: ' . mysqli_error($db));
            }

            // Set Success Message, remove sticky form values
            $message = '<p class="message">One Record Created</p>';
            $term = '';
        }
        else {
            $message = '<p class="message">Fields may not be empty</p>';
        }
    }

    // sql query
    $sql = "SELECT * FROM groups WHERE id = '$id'";

    if(!mysqli_query($db, $sql))
    {
        die("Error: " . mysqli_error($db));
    }

    $result = $db->query($sql);
}

// HTML Page Header
$header = <<<EOF
<!DOCTYPE html>
<html>
  <head>
    <meta charset='UTF-8'>
    <title>$pageTitle</title>
    <link rel='stylesheet' href='style.css' />
  </head>
  <body>
EOF;
echo $header;

include 'include/menu.php';

if($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    $form = '
    <form action="/editgroup.php" method="POST" >
        <input type="hidden" name="id" value="' . $id . '" />
        <label for="name">Name</label>
        <input type="text" name="name" value="' . $row['name'] . '" />
        <input class="button" type="submit" name="submit" value="Update"></button>
    </form>
    ';
    echo $form;
}

// Add Cards to Group
echo "<a href='/associate.php?id=$id' class='button'>Associate Cards</a>";

// HTML Footers
$footer = <<<EOF
  </body>
  </html>
EOF;
echo $footer;

// close db connections
require 'include/end.php';
?>