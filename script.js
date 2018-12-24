// Starting at the beginning of the card list
var index = 0;

// Get number of cards
var numberOfCards = document.getElementsByClassName('flip-card').length - 1;

// Obtain controls
var nextButton = document.getElementById('next');
var previousButton = document.getElementById('previous');

// Obtain position outputs and set
var position = document.getElementById('position');
var total = document.getElementById('total');
total.innerHTML = numberOfCards + 1;
position.innerHTML = 1;

// Button Actions
nextButton.addEventListener('click', function(){
    if(index < numberOfCards) changeCard(1);
});

previousButton.addEventListener('click', function(){
    if(index > 0) changeCard(-1);
});

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
}