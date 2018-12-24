<?php

// load database, configs, etc.
require 'include/env.php';

// query for all flashcards
$sql = "select * from flashcards";
$result = $db->query($sql);

// Create Flashcard Table
$table = "<table>";
$table = $table . "<tr><th>Term</th><th>Definition</th><th>Admin</th></tr>";

// Parse flashcard results into table rows
if($result->num_rows > 0)
{
  while($row = $result->fetch_assoc())
  {
    $table = $table 
      . "<tr><td>" 
      . $row['term'] 
      . "</td><td>" 
      . $row['definition'] 
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

//////// Admin Section ////////
// view embeded tool
echo "<a href='/embed.php' class='button'>Embedded Flashcard Tool</a>";
echo "<a href='/add.php' class='button'>Add New Cards</a>";
////// End Admin Section //////

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