// Starting at the beginning of the card list
var index = 0;

// Get number of cards
var numberOfCards = document.getElementsByClassName('flip-card').length - 1;

// Obtain controls
var nextButton = document.getElementById('next');
var previousButton = document.getElementById('previous');
var toggleTermButton = document.getElementById('toggleTerm');

// Obtain position outputs and set
var position = document.getElementById('position');
var total = document.getElementById('total');
total.innerHTML = numberOfCards + 1;
position.innerHTML = 1;

// Obtain and Update Progress Bar
var progressBar = document.getElementById('progress-bar');
updateProgressBar();

// Button Actions
nextButton.addEventListener('click', function(){
    if(index < numberOfCards) changeCard(1);
});

previousButton.addEventListener('click', function(){
    if(index > 0) changeCard(-1);
});

toggleTermButton.addEventListener('click', function(){
    toggleTerms();
});

// Logic for Arrow Key Interaction
document.onkeydown = checkKey;
function checkKey(e)
{
    e = e || window.event;

    if (e.keyCode == '38') {
        // up arrow
    }
    else if (e.keyCode == '40') {
        // down arrow
    }
    else if (e.keyCode == '37') {
        // left arrow
        if(index > 0) changeCard(-1);
    }
    else if (e.keyCode == '39') {
        // right arrow
        if(index < numberOfCards) changeCard(1);
    }
}

// Logic for switching cards
function changeCard(incrementor)
{
    // Get all flip cards
    var cards = document.getElementsByClassName('flip-card');
    // Hide current
    cards[index].classList.add('hidden');
    // Get next/previous index
    index += incrementor;
    // Update position in sidebar
    position.innerHTML = index + 1;
    // Show next/previous
    cards[index].classList.remove('hidden');
    // Update Progress Bar
    updateProgressBar();
}

// Logic to update the progress bar
function updateProgressBar()
{
    var width = (index + 1) / (numberOfCards + 1) * 100;
    progressBar.style.width = width + '%';
}

// Logic to toggle the flashcard terms/definitions
function toggleTerms()
{
    console.log('toggleTerms() reached');
    // Get all flip cards
    var cards = document.getElementsByClassName('flip-card');
    
    for (i = 0; i < cards.length; i++)
    {
        // Store Text Values
        var frontText = cards[i]
            .getElementsByClassName('flip-card-front')[0]
            .getElementsByClassName('card-text')[0].innerHTML;
        
        var backText = cards[i]
            .getElementsByClassName('flip-card-back')[0]
            .getElementsByClassName('card-text')[0].innerHTML;
        console.log(frontText, backText);

        // Assign Text Values
        cards[i].getElementsByClassName('flip-card-front')[0]
            .getElementsByClassName('card-text')[0].innerHTML = backText;
        cards[i].getElementsByClassName('flip-card-back')[0]
            .getElementsByClassName('card-text')[0].innerHTML = frontText;
    }
} 