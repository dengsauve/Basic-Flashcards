var index = 0;
var numberOfCards = document.getElementsByClassName('flip-card').length - 1;
var nextButton = document.getElementById('next');
var previousButton = document.getElementById('previous');

nextButton.addEventListener('click', function(){
    if(index < numberOfCards)
    {
        var cards = document.getElementsByClassName('flip-card');
        cards[index].classList.add('hidden');
        index += 1;
        cards[index].classList.remove('hidden');
    }
});

previousButton.addEventListener('click', function(){
    if(index > 0)
    {
        var cards = document.getElementsByClassName('flip-card');
        cards[index].classList.add('hidden');
        index -= 1;
        cards[index].classList.remove('hidden');
    }
});