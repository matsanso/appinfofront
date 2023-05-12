const searchIcon = document.querySelector('.search-icon');
const searchInput = document.getElementById('search');

function adjustInputSize() {
  const inputValue = searchInput.value.trim();
  searchInput.setAttribute('size', Math.max(inputValue.length, 8));
}



/*section features*/

$(document).ready(function () {
  $('.num').counterUp({
    time: 800
  });
});