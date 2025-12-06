<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Connect to the database
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Read the GET variable
$country = $_GET['country'] ?? '';

// If the user entered a country name, FILTER results
if (!empty($country)) {
    $stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state 
                            FROM countries 
                            WHERE name LIKE :country");
    $search = "%$country%";
    $stmt->bindParam(':country', $search, PDO::PARAM_STR);
    $stmt->execute();
}
// If search box is empty → return ALL countries
else {
    $stmt = $conn->query("SELECT name, continent, independence_year, head_of_state 
                          FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output HTML TABLE
if ($results) {
    echo "<table>";
    echo "<tr>
            <th>Country</th>
            <th>Continent</th>
            <th>Independence Year</th>
            <th>Head of State</th>
          </tr>";

    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['continent']) . "</td>";
        echo "<td>" . htmlspecialchars($row['independence_year'] ?? 'N/A') . "</td>";
        echo "<td>" . htmlspecialchars($row['head_of_state'] ?? 'N/A') . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>No results found.</p>";
}
?>
