<?php
  echo $mysqli->host_info . "\n";

  $sql = "SELECT place_id, place_name, place_location, place_description FROM places";
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<br>" . "id: " . $row["place_id"] . "<br>" .
      "Name: " . $row["place_name"]. "<br>" .
      "Location: " .$row["place_location"]. "<br>" .
      "Description: " .$row["place_description"] ."<br>";
    }
  } else {
    echo "0 results";
  }
  $mysqli->close();
?>