function searchFunction() {

    let input = document.getElementById('searchBar').value.toLowerCase();
    
    // Get all the card elements
    let cards = document.querySelectorAll('.card-container .card');
    
    // Get other content that should be hidden during the search
    let otherContent = document.querySelectorAll('.other-content');
    
    // Get the no results message element
    let noResultsMessage = document.getElementById('noResultsMessage');
    
    // Determine if the search input is empty
    if (input === "") {
        // Show all other content when search is empty
        otherContent.forEach(content => {
            content.style.display = ''; // Show other content
        });
        noResultsMessage.style.display = 'none'; // Hide no results message
    } else {
        // Hide other content while searching
        otherContent.forEach(content => {
            content.style.display = 'none'; // Hide other content
        });
        
        let hasResults = false; // Flag to check if there are matching results
        
        // Loop through all cards and match titles with the input
        for (let i = 0; i < cards.length; i++) {
            let title = cards[i].querySelector('.card-title').textContent || "";
            
            // Check if the title contains the search query
            if (title.toLowerCase().indexOf(input) > -1) {
                cards[i].style.display = ''; // Show card if title matches
                hasResults = true; // Set flag to true if there is a match
            } else {
                cards[i].style.display = 'none'; // Hide card if title doesn't match
            }
        }

        // Show or hide no results message based on whether there are matching results
        noResultsMessage.style.display = hasResults ? 'none' : 'block'; // Show message if no results found
    }
}