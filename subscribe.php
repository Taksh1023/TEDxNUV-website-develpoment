<?php
if(isset($_POST['submit'])){
  $servername = "localhost:3306";
  $username = "root";
  $password = "taksh@9879204830";
  $dbname = "admin";
  
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully";
  
  // Handle form submission and insert email into the database
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = $_POST["email"];
      $sql = "INSERT INTO tedx (email) VALUES ('$email')";
  
      if (mysqli_query($conn, $sql)) {
          echo "New record created successfully";
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
  }
  
  // Close connection
  mysqli_close($conn);
}
  ?>
  
