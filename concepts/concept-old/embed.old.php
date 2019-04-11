<?php

require 'include/env.php';

// query for all flashcards
$sql = 'select flashcards.*
from flashcard_groups
join flashcards on flashcards.id = flashcard_groups.flashcard_id
where flashcard_groups.group_id = 1';
$result = $db->query($sql);
$group_name = "Sample Group";

// Get group from $_GET
$group = $_GET['group'];
if(!empty($group))
{
    $sql = "select name
                from groups
                where id = $group";
    $name_result = $db->query($sql);
    $group_name = $name_result->fetch_assoc()['name'];

    if(empty($group_name))
    {
        $group_name = "Sample Group";
    }
    else 
    {
        $sql = "select flashcards.*
        from flashcard_groups
        join flashcards on flashcards.id = flashcard_groups.flashcard_id
        where flashcard_groups.group_id = $group";
        $result = $db->query($sql);
    }
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

// Admin Menu
if($admin) include 'include/menu.php';

// Application Container Open
$app_container = <<<EOF
    <div class="app-container">
        <h2>Study Group: $group_name</h2>
        <div class="status-cards">
EOF;
echo $app_container;

// Status Bar
$status_bar = <<<EOF
    <div class='status-bar'>
        <div class="w3-light-grey">
            <div id="progress-bar" class="w3-green"></div>
        </div>
        <p>
            Progress: 
            <span id='position'>
                1
            </span>
            /
            <span id='total'>
                1
            </span>
        </p>
        <button id="toggleTerm" class="button">Toggle Term/Definition</button>
    </div>
EOF;
echo $status_bar;

// Flashcards
if($result->num_rows > 0)
{
    $notFirst = false;
    $hidden = '';
  while($row = $result->fetch_assoc())
  {
    if($notFirst)
    {
        $hidden = ' hidden';
    }
    $card = "
            <div class='flip-card" . $hidden . "'>
                <div class='flip-card-inner'>
                    <div class='flip-card-front'>
                        <p class='card-text'>" . $row['term'] . "</p>
                    </div>
                    <div class='flip-card-back'>
                        <p class='card-text'>" . $row['definition'] . "</p>
                    </div>
                </div>
            </div>
            ";
    echo $card;
    $notFirst = true;
  }
}

// Next/Previous Button Bar
echo "
</div>
<br/>
<div class='bar'>
    <button class='button previous-button' id='previous'>Previous</button>
    <button class='button next-button' id='next'>Next</button>
</div>";

// Application Container Close
$app_container = <<<EOF
    </div>
EOF;
echo $app_container;

// HTML Footers
$footer = <<<EOF
  <script type='text/javascript' src='script.js'></script>
  </body>
  </html>
EOF;
echo $footer;

require 'include/end.php';