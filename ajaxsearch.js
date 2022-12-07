var searchInput = document.getElementById('search-input');
var searchButton = document.getElementById('search-button');
var select = document.getElementById('categorysList');
// Add an event listener to the search button
searchButton.addEventListener('click', function() {
  // Get the search term from the input
  var searchTerm = searchInput.value;
  var category  = select.value;

  // Set up the Ajax request
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'searchproduct.php?search=' + searchTerm +'&category=' +category+"&onload=false");
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Update the page with the new list of products
      document.getElementById('products').innerHTML = xhr.responseText;
    }
  };
  xhr.send();
});







function Loadfunction() {
  // Set up the Ajax request
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'searchproduct.php');
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Update the page with the new list of products
      document.getElementById('products').innerHTML = xhr.responseText;
    }
  };
  xhr.send();



  var aaa = new XMLHttpRequest();
  aaa.open('GET', 'searchproduct.php?category=None');
  aaa.onload = function() {
    if (aaa.status === 200) {
      // Update the page with the new list of products
      document.getElementById('categorysList').innerHTML = aaa.responseText;
    }
  };
  aaa.send();
}


