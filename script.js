function searchMovies(event) {
    event.preventDefault(); // prevent form from submitting and reloading the page
    const input = document.querySelector('.search input[type="text"]');
    const searchTerm = input.value.trim();
    if (searchTerm) {
      // perform search using the searchTerm variable
      console.log(`Searching for movies with title "${searchTerm}"`);
    } else {
      alert('Please enter a search term'); // show an error message if the search term is empty
    }
  }
  
  const form = document.querySelector('.search form');
  form.addEventListener('submit', searchMovies);
  