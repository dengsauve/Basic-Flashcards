<?php

// load database, configs, etc.
require 'env.php';

// query for all flashcards
$sql = "select * from flashcards";
$result = $db->query($sql);

// Create Flashcard Table
$table = "<table>";
$table = $table . "<tr><th>Term</th><th>Definition</th></tr>";

// Parse flashcard results into table rows
if($result->num_rows > 0)
{
  while($row = $result->fetch_assoc())
  {
    $table = $table . "<tr><td>" . $row['term'] . "</td><td>" . $row['definition'] . "</td></tr>";
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
  </head>
  <body>
EOF;
echo $header;

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
require 'end.php';
?>