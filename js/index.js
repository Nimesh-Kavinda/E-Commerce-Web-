   // Scroll to the top of the page
    document.getElementById('topBtn').addEventListener('click', function() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Scroll to the bottom of the page
    document.getElementById('bottomBtn').addEventListener('click', function() {
      window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
    });
  