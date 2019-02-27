<?php

require 'include/env.php';

////////////////////////////////
// START OF FLASHCARD QUERIES //
////////////////////////////////
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

//////////////////////////////
// END OF FLASHCARD QUERIES //
//////////////////////////////

// HTML Page Header
$header = <<<EOF
<!DOCTYPE html>
<html>
  <head>
    <meta charset='UTF-8'>
    <title>title</title>
    <link rel='stylesheet' href='style.2.css' />
  </head>
  <body>
EOF;
echo $header;

// Admin Menu
if($admin) include 'include/menu.php';

// Application Container Open
$app_container = <<<EOF
    <div class="app-container">
        <div class="title-bar">
            <h2>Study Group: $group_name</h2>
        </div>
        <div class="app-body">
EOF;
echo $app_container;

// Flashcards
if($result->num_rows > 0)
{
    $notFirst = false;
    $hidden = '';
    while($row = $result->fetch_assoc())
    {
        // Hide the following cards that are generated (only showing the first)
        if($notFirst)
        {
            $hidden = ' hidden';
        }
        
        $card = "
                <div class='card-container $hidden'>
                    <div class='card-front'>
                        <p class='hint-box hidden'>" . substr($row['definition'], 0, 20) . "...</p>
                        <p class='term'>" . $row['term'] . "</p>
                    </div>
                    <div class='card-back hidden'>
                        <p class='term-box'>" . $row['term'] . "</p>
                        <p class='definition'>" . $row['definition'] . "</p>
                    </div>
                </div>
        ";
        echo $card;
        $notFirst = true;
    }
}

// Next/Previous Button Bar
echo "
<div class='bar'>
    <button class='button previous-button' id='previous'>Previous</button>
    <button class='button next-button' id='next'>Next</button>
</div>
";

// Status Bar
$status_bar = <<<EOF
    <div class='status-bar'>
        <div class='progress-group'>
            <progress value="1" max="1" id="progress-bar"></progress>
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
        </div>
        <div class='toggle-group'>
            <button id="toggleTerm" class="button toggle-button">Toggle</button>
            <p class='help'>Toggle between Term and Definition</p>
        </div>
    </div>
EOF;
echo $status_bar;

// Application Container Close
$app_container = <<<EOF
        </div><!-- end app-body -->
    </div><!-- end app-container -->
EOF;
echo $app_container;

// HTML Footers
$footer = <<<EOF
  <script type='text/javascript' src='script.2.js'></script>
  </body>
  </html>
EOF;
echo $footer;

require 'include/end.php';