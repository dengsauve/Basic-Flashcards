<?php

// load database, configs, etc.
require 'include/env.php';

// query for all flashcards
$sql = "select * from flashcards";
$result = $db->query($sql);

// Create Flashcard Table
$table = "<table>";
$table = $table . "<tr><th>Term</th><th>Definition</th><th>Groups</th><th>Admin</th></tr>";

// Parse flashcard results into table rows
if($result->num_rows > 0)
{
  while($row = $result->fetch_assoc())
  {
      // Grab all groups that the card belongs to
      $sql = "select groups.name 
                from flashcard_groups
                left join groups on groups.id = flashcard_groups.group_id
                where flashcard_id = " . $row['id'];
      $names = $db->query($sql);
      $name_array = array();

      while($name_row = $names->fetch_assoc())
      {
        array_push($name_array, $name_row['name']);
      }

      $table = $table 
        . "<tr><td>" 
        . $row['term'] 
        . "</td><td>" 
        . substr($row['definition'], 0, 50)
        . "</td><td>"
        . implode(",", $name_array)
        . "</td><td><a href='/edit.php?id="
        . $row['id']
        . "' class='button'>Edit</a>"
        . "</td></tr>";
  }
}

// Close Table
$table = $table . "</table>";

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

// Flashcards Section
echo "<h1>Flashcards</h1>";
echo $table;

// HTML Footers
$footer = <<<EOF
  </body>
  </html>
EOF;
echo $footer;

// close db connections
require 'include/end.php';
?>