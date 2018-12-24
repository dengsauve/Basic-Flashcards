<?php

require 'include/env.php';

// get id of editable card
$id = mysqli_real_escape_string($db, $_GET['id']);
// if none is passed, try to get from $_POST data
if(empty($id)) $id = mysqli_real_escape_string($db, $_POST['id']);

if(!empty($id))
{
    // sql query
    $sql = "SELECT * FROM flashcards WHERE id = '$id'";

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
    <title>title</title>
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
    <form action="/edit.php" method="POST" >
        <input type="hidden" name="id" value="' . $id . '" />
        <label for="term">Term</label>
        <input type="text" name="term" value="' . $row['term'] . '" />
        <label for="definition">Definition</label>
        <input type="text" name="definition" value="' . $row['definition'] . '" />
        <input class="button" type="submit" name="submit" value="Create"></button>
    </form>
    ';
    echo $form;
}

// HTML Footers
$footer = <<<EOF
  </body>
  </html>
EOF;
echo $footer;

// close db connections
require 'include/end.php';
?>