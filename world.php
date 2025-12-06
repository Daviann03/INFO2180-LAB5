<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? '';
$countryLike = "%$country%";



if ($lookup === "cities") {

    $stmt = $conn->prepare("
        SELECT cities.name, cities.district, cities.population
        FROM cities
        JOIN countries ON cities.country_code = countries.code
        WHERE countries.name LIKE :country;
    ");
    $stmt->bindParam(':country', $countryLike);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output table
    echo "<table>";
    echo "<tr>
            <th>City Name</th>
            <th>District</th>
            <th>Population</th>
          </tr>";

    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['district']) . "</td>";
        echo "<td>" . number_format($row['population']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    exit;
}



if (!empty($country)) {
    $stmt = $conn->prepare("
        SELECT name, continent, independence_year, head_of_state
        FROM countries
        WHERE name LIKE :country
    ");
    $stmt->bindParam(':country', $countryLike);
    $stmt->execute();
} else {
    $stmt = $conn->query("
        SELECT name, continent, independence_year, head_of_state
        FROM countries
    ");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Output country table
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
?>
