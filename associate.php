<?php

require 'include/env.php';
$pageTitle = "Associate Flashcards";
$debug = true;

// Check for submissions
if($_POST['submit'] == 'submit')
{
    $cards = $_POST['cards'];
    $id = $_POST['id'];
    if( count($cards) > 0 && !empty($id))
    {
        foreach($cards as $card)
        {
            $sql = "select *
                        from flashcard_groups
                        where group_id = $id and flashcard_id = $card";
            $result = $db->query($sql);
            if($result->num_rows == 0)
            {
                $sql = "insert into flashcard_groups
                            (group_id, flashcard_id)
                            values ('$id', '$card')";
                $result = $db->query($sql);
            }
        }
    }
}

// get id of editable card
$id = mysqli_real_escape_string($db, $_GET['id']);
// if none is passed, try to get from $_POST data
if(empty($id)) $id = mysqli_real_escape_string($db, $_POST['id']);

if(!empty($id))
{
    $sql = "select name from groups where id=$id";
    $result = $db->query($sql);
    $group_name = $result->fetch_assoc()['name'];
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

// debugging
if($debug && !empty($_POST['submit']))
{
    echo "cards: ";
    echo implode(',', $_POST['cards']);
    echo '<br />';
    echo "submit: " . $_POST['submit'];
    echo '<br />';
    echo "id: " . $_POST['id'];
    echo '<br />';
}

echo "<h1>$group_name</h1>";

// Get Flashcards
$sql = "select * from flashcards";
$result = $db->query($sql);

// Create Form
$form = <<<EOF
    <form action='/associate.php?id=$id' method='POST'>
        <input type='hidden' name='id' value='$id' />
        <label for='cards'>Cards to Associate</label>
        <select multiple name='cards[]' size='20'>
EOF;
echo $form;

// Display List of Cards to Associate w/Group
while($row = $result->fetch_assoc())
{
    echo "<option value='"
        . $row['id']
        . "'>"
        . $row['term']
        . "</option>";
}

// Close Form
$form_end = <<<EOF
        </select>
        <p class='help-text'>
            To select multiple values, hold "cmd" or "ctrl" while clicking.
        </p>
        <p class='help-text'>
            To select multiple continuous values, 
            click the start of your selection, 
            hold "shift", and click the end of your selection.
        </p>
        <button type='submit' name='submit' value='submit' class='button'>
            Associate
        </button>
    </form>
EOF;
echo $form_end;

// HTML Footers
$footer = <<<EOF
  </body>
  </html>
EOF;
echo $footer;

// close db connections
require 'include/end.php';
?>