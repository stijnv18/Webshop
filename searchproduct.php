<?php
// Connection parameters
$servername = "localhost";
$usernamedb = "root";
$passworddb = "";
$dbname = "webshop";
// Connect to the database
$conn = new mysqli($servername, $usernamedb, $passworddb, $dbname);

// Check for connection errors
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Set up the query
$query = "SELECT * FROM product";
$category = "SELECT product.name FROM category INNER JOIN product ON product.category_id = category.id ";
// Get the search term from the query string, if it exists
$search = isset($_GET['search']) ? $_GET['search'] : '';
$categorySet = isset($_GET['category']) ? $_GET['category'] : '';
$onload =  isset($_GET['onload']) ? $_GET['onload'] : '';
// If a search term exists, add it to the query
if ($search && $categorySet && $categorySet!="None") {
  $category .= "WHERE category.name like '%$categorySet%'  AND product.name like '%$search%'";
  $query =  $category;
}
else if ($search) {
  $search .= " WHERE product.name LIKE '%$search%'";
}

else if($search || $categorySet!="None"){
 $category.="WHERE category.name like '%$categorySet%'";
 $query = $category;
}
else if(!$search && $categorySet=='None' && $onload=='false'){
  $query = "SELECT * FROM product";
}
else if($categorySet){
    $query = "SELECT * FROM category";
}


// Execute the query

$result = $conn->query($query);

// Check for query errors
if (!$result) {
  die("Query failed: " . $conn->error);
}

// Loop through the results and output them as a list of products
if((!$categorySet || ($categorySet&& $search)  || ($search || $categorySet!="None"))||$onload=='false'){
  echo "<ul>";
  while ($row = $result->fetch_assoc()) {
    echo "<li>" . $row['name'] . "</li>";
  }
  echo "</ul>";
}
else if($categorySet=='None' && !$search){
  echo "<option value='None'>None</option>";
  while ($row = $result->fetch_assoc()) {
    echo "<option value='". $row['name'] . "'>".$row['name']."</option>";
  }
}


// Close the connection
$conn->close();

?>