<?php

require 'include/env.php';

// query for all groups
$sql = 'select * from groups';
$result = $db->query($sql);

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

// Admin Menu
include 'include/menu.php';

// Create Group Table
$table = "<table>";
$table = $table . "<tr><th>Name</th><th>Admin</th></tr>";

// Parse flashcard results into table rows
if($result->num_rows > 0)
{
  while($row = $result->fetch_assoc())
    {
        $table = $table 
            . "<tr><td>" 
            . $row['name']  
            . "</td>";
    
        $table = $table . "<td><a href='/editgroup.php?id="
            . $row['id']
            . "' class='button'>Edit</a>"
            . "</td></tr>";
  }
}

// Close Table
$table = $table . "</table>";
echo $table;