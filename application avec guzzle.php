<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;

if (isset($_GET['movies'])) {
    $apikey = "05369f8c3f63c1d5a8113dee4713ec25";
    $film = $_GET['movies'];
    $url = "https://api.themoviedb.org/3/search/movie?api_key=$apikey&query=" . urlencode($film);

    $client = new Client();

    try {
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() === 200) {
            $body = $response->getBody();
            header('Content-Type: application/json');
            echo $body;
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur lors de la récupération des données.']);
        }
    } catch (\Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Erreur lors de la requête.']);
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Vision</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f5f5;
      padding: 20px;
    }

    .container {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    input {
      padding: 10px;
      width: 70%;
      margin-right: 10px;
    }

    button {
      padding: 10px;
    }

    img {
      margin-top: 15px;
      max-width: 100%;
    }
  </style>

</head>
<body>
  <div class="container">
    <h1>Recherche de film</h1>
    <form id="movie-form">
      <input type="text" id="movie-input" placeholder="Entrez un nom de film">
      <button type="submit">Rechercher</button>
    </form>
    <div id="results"></div>
  </div>

  <script>
    const form = document.getElementById('movie-form');
    const input = document.getElementById('movie-input');
    const results = document.getElementById('results');

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const query = input.value.trim();

      if (query) {
        fetch(`?movies=${encodeURIComponent(query)}`)
          .then(res => res.json())
          .then(data => {
            if (data.results && data.results.length > 0) {
              const movie = data.results[0];
              results.innerHTML = `
                <h2>${movie.title}</h2>
                <p>${movie.overview}</p>
                <p>Date de sortie : ${movie.release_date}</p>
                <img src="https://image.tmdb.org/t/p/w300${movie.poster_path}" alt="${movie.title}">
              `;
            } else {
              results.innerHTML = "<p>Aucun film trouvé.</p>";
            }
          })
          .catch(err => {
            results.innerHTML = "<p>Erreur lors de la récupération des données.</p>";
          });
      }
    });
  </script>
</body>
</html>


