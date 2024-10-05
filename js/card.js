
var cards = document.querySelectorAll(".card");


cards.forEach(function(card) {
    card.addEventListener("mouseover", function() {
        card.style.transition = "transform 0.3s ease"; 
        card.style.transform = "scale(1.045)"; 
    });

    card.addEventListener("mouseout", function() {
        card.style.transform = "scale(1)"; // 
    });
});
