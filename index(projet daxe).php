<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;

if (isset($_GET['movies'])) {
    $apikey = "05369f8c3f63c1d5a8113dee4713ec25";
    $film = $_GET['movies'];
    $url = "https://api.themoviedb.org/3/search/movie?api_key=$apikey&query=" . urlencode($film);

    $response = file_get_contents($url);
    if ($response === FALSE) {
        http_response_code(500);
        echo json_encode(['error'=>'Erreur lors de la récupération des données.']);
        exit;
    }

    header('Content-Type: application/json');
    echo $response;
    exit;
}
?>




  <style>

html, body {
      font-family: Arial, sans-serif;
      background-color: white;
      height: 100%;
      margin: 0;
      padding: 0;

    }

    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family:Arial, Helvetica, sans-serif ;  
      }


  .header-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 40px 10px;
    color: white;
    background-color : #000000 ;
    
  }

  .logo img {
    height: 180px;
  
  }

  .search-bar {
    flex: 1;
    display: flex;
    justify-content: center;
    position: absolute;
    right : 50px;
    top : 100px
  }

  .search input {
    padding: 8px;
    width: 250px;
    border-radius: 4px 0 0 4px;
    border: none;
  }

  .search button {
    padding: 8px 12px;
    border-radius: 0 4px 4px 0;
    border: none;
    background-color: #333;
    transition: background 0.3s;
    color: white;
    cursor: pointer;
  }

  .search button:hover {
    background-color :  #8c52ff;
  }


  .auth-links {
    display: flex;
    gap: 15px;
    position : absolute;
    top: 100px;
    right : 450px;
  }

  .auth-links img{
    height : 50%;
  }

  


.main-content {
    flex: 1 0 auto; 
}









</style>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Vision</title>
</head>
<body>

<header>
  <nav class="header-nav">

    <div class="logo">
      <a href="http://localhost/php/index.php">
        <img src="logo.png" alt="Logo" />
      </a>
    </div>

    <div class="search-bar">
      <form class="search" id="movie-form">
        <input type="text" id="movie-input" placeholder="Entrez un nom de film" />
        <button type="submit">Rechercher</button>
      </form>
    </div>


    <div class="auth-links">
      <a href="register.html" class="register">
        <img src="register.png" alt="inscription">
      </a>
      <a href="login.html" class="login">
        <img src="login.png" alt="connexion">
      </a>
    </div>
  </nav>
</header>



<div id="results"></div>


<div class="main-content">
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

<script src="main.js"></script>
</body>

</html>



