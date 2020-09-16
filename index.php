<?php 


  use Symfony\Component\Dotenv\Dotenv;

  require __DIR__ . '/vendor/autoload.php';
  
  $dotenv = new Dotenv();
  $dotenv->load(__DIR__.'/.env');

  var_dump($_ENV['PORT']);
  // var_dump(getenv('PORT'));