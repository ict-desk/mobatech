<?php
$baseUrl = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mobatech Holland</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: #f0f0f0;
      color: #222;
      text-align: center;
      padding: 60px 20px;
    }
    img {
      max-width: 100%;
      height: auto;
    }
    h1 {
      margin-top: 30px;
      font-size: 2em;
    }
    p {
      color: #666;
      font-size: 1.2em;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <img src="<?= $baseUrl ?>/Image/placeholder.jpg" alt="Mobatech placeholder">
  

</body>
</html>