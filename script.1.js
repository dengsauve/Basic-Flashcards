// Starting at the beginning of the card list
var index = 0;

// Initial Card will not be flipped, or toggled
var flipped = false;
var toggled = false;

// Get number of cards
var numberOfCards = document.getElementsByClassName('card-container').length - 1;

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
    if(index < numberOfCards || !flipped) changeCard(1);
});

previousButton.addEventListener('click', function(){
    if(index > 0 || flipped) changeCard(-1);
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
    var cards = document.getElementsByClassName('card-container');
    
    // check if flipped
    if (flipped && incrementor == 1) // Move on to the next card
    {
        // Moving on to the next card, which is unflipped
        flipped = false;
        // Show the front
        cards[index].getElementsByClassName('card-front')[0].classList.remove('hidden');
        // Hide the back
        cards[index].getElementsByClassName('card-back')[0].classList.add('hidden');
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
    else if(flipped && incrementor == -1) // Unflip the card
    {
        // Moving on to the next card, which is unflipped
        flipped = false;
        // Show the front
        cards[index].getElementsByClassName('card-front')[0].classList.remove('hidden');
        // Hide the back
        cards[index].getElementsByClassName('card-back')[0].classList.add('hidden');
    }
    else if(!flipped && incrementor == -1) // Move to the previos card
    {
        // Move to the previous card, which is unflipped
        flipped = false;
        // Show the front
        cards[index].getElementsByClassName('card-front')[0].classList.remove('hidden');
        // Hide the back
        cards[index].getElementsByClassName('card-back')[0].classList.add('hidden');
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
    else // !flipped && incrementor == 1 // Show the flip side 
    {
        // Card is now flipped
        flipped = true;
        // Hide the front
        cards[index].getElementsByClassName('card-front')[0].classList.add('hidden');
        // Show the back
        cards[index].getElementsByClassName('card-back')[0].classList.remove('hidden');
    }
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
    var cards = document.getElementsByClassName('card-container');
    
    for (i = 0; i < cards.length; i++)
    {
        if(!toggled)
        {
            // Flip front to back
            // Hide the front
            cards[i]
                .getElementsByClassName('card-front')[0]
                .classList.add('hidden');
            // Show the hint box
            cards[i]
                .getElementsByClassName('card-front')[0]
                .getElementsByClassName('hint-box')[0]
                .classList.remove('hidden');
            // Make the front the back
            cards[i]
                .getElementsByClassName('card-front')[0]
                .classList.replace('card-front', 'card-back');
            
            // Flip back to front
            // Show the "back"
            cards[i]
                .getElementsByClassName('card-back')[1]
                .classList.remove('hidden');
            // Hide the term box
            cards[i]
                .getElementsByClassName('card-back')[1]
                .getElementsByClassName('term-box')[0]
                .classList.add('hidden');
            // Make the back the front
            cards[i]
                .getElementsByClassName('card-back')[1]
                .classList.replace('card-back','card-front');
        }
        else
        {
            // Flip back to front
            // Show the "back"
            cards[i]
                .getElementsByClassName('card-back')[0]
                .classList.remove('hidden');
            // Hide the hint box
            cards[i]
                .getElementsByClassName('card-back')[0]
                .getElementsByClassName('hint-box')[0]
                .classList.add('hidden');
            // Make the back the front
            cards[i]
                .getElementsByClassName('card-back')[0]
                .classList.replace('card-back','card-front');
            
            // Flip front to back
            // Hide the front
            cards[i]
                .getElementsByClassName('card-front')[1]
                .classList.add('hidden');
            // Show the term box
            cards[i]
                .getElementsByClassName('card-front')[1]
                .getElementsByClassName('term-box')[0]
                .classList.remove('hidden');
            // Make the front the back
            cards[i]
                .getElementsByClassName('card-front')[1]
                .classList.replace('card-front', 'card-back');
        }
    }
    // Flip toggle
    toggled = !toggled;
} 