<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>User Search</title>
</head>
<body>
    <div class="container">
        <h1>Search Users</h1>
        <form method="post">
            <label for="search_term">Enter First or Last Name:</label>
            <input type="text" id="search_term" name="search_term" required>
            <button type="submit">Search</button>
        </form>

        <?php
        // connection
        $MySQL = mysqli_connect("localhost", "root", "", "ntpws") or die('Error connecting to MySQL server.');

        // check the form (submited or not)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
            $searchTerm = mysqli_real_escape_string($MySQL, $_POST['search_term']);

            // query
            $query = "SELECT * FROM users WHERE user_firstname LIKE '%$searchTerm%' OR user_lastname LIKE '%$searchTerm%'";
            $result = mysqli_query($MySQL, $query);


            if (mysqli_num_rows($result) > 0) {
                echo "<h2>Search Results:</h2><ul>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>" . htmlspecialchars($row['user_firstname']) . " " . htmlspecialchars($row['user_lastname']) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No users found with that name.</p>";
            }

            mysqli_free_result($result);
        }

        mysqli_close($MySQL);
        ?>
    </div>
</body>
</html>
