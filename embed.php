<?php

require 'env.php';

// query for all flashcards
$sql = 'select * from flashcards';
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

// Status Bar
$status_bar = <<<EOF
    <div class='status-bar'>
        <p>
            <span id='position'>
                1
            </span>
            /
            <span id='total'>
                1
            </span>
        </p>
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
<br/>
<div class='bar'>
    <button class='button previous-button' id='previous'>Previous</button>
    <button class='button next-button' id='next'>Next</button>
</div>";

// HTML Footers
$footer = <<<EOF
  <script type='text/javascript' src='script.js'></script>
  </body>
  </html>
EOF;
echo $footer;

require 'end.php';