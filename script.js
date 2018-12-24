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

nextButton.addEventListener('click', function(){
    if(index < numberOfCards)
    {
        var cards = document.getElementsByClassName('flip-card');
        cards[index].classList.add('hidden');
        index += 1;
        position.innerHTML = index + 1;
        cards[index].classList.remove('hidden');
    }
});

previousButton.addEventListener('click', function(){
    if(index > 0)
    {
        var cards = document.getElementsByClassName('flip-card');
        cards[index].classList.add('hidden');
        index -= 1;
        position.innerHTML = index + 1;
        cards[index].classList.remove('hidden');
    }
});