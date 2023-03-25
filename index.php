<?php

$search = '';
if (isset($_GET['search'])){
    $search = $_GET['search'];
}

$url = "https://www.googleapis.com/customsearch/v1?key=AIzaSyDrIyIV6oJr1gTAISx24aiPMuWe_YWLIUQ=&cx=41c3ee004772d4387&q={$search}";

$curlClient = curl_init();
curl_setopt($curlClient, CURLOPT_URL, $url);
curl_setopt($curlClient, CURLOPT_RETURNTRANSFER, true);
$responseJson = curl_exec($curlClient);
curl_close($curlClient);

$responseArray = json_decode($responseJson, true);
//var_dump($responseJson);


?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            h2 {
                margin-top: 30px;
            }
            label {
                font-weight: bold;
            }
            input[type="text"] {
                width: 300px;
                padding: 5px;
                border-radius: 5px;
                border: 1px solid #ccc;
            }
            input[type="submit"] {
                padding: 10px 20px;
                background-color: #4CAF50;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            .search-result {
                margin-top: 20px;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            .search-result h3 {
                margin-top: 0;
            }
        </style>
        <meta charset="UTF-8">
        <title>Title</title>
    </head>
    <body>

            <script async src="https://cse.google.com/cse.js?cx=41c3ee004772d4387">
            </script>
            <div class="gcse-search"></div>

            <h2>My Browser</h2>
            <form method="GET" action="/index.php">
                <label for="search">Search:</label>
                <input type="text" id="search" name="search" value="">
                <input type="submit" value="Submit">
            </form>

            <?php
            foreach ($responseArray['items'] as $item) {
                $title = $item['title'];
                $link = $item['link'];
                $snippet = $item['snippet'];
                echo "<div class='search-result'>";
                echo "<h3><a href='$link'>$title</a></h3>";
                echo "<p>$snippet</p>";
                echo "</div>";
            }
            ?>
    </body>
</html>

