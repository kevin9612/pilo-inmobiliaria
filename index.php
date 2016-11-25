<?php

if ( substr($_SERVER["REQUEST_URI"], -1) == '/'
     && substr($_SERVER["REQUEST_URI"], -10) != 'index.php/') {
  header("Location: index.php");
  die();
}

$app = require_once __DIR__.'/App/App.php';

$app->get('/', function() use($app) {
  
  return $app->redirect( $app['url_generator']->generate('home'));
});

$app->mount('/login', new App\Login\logincontroller());
$app->mount('/registrar', new App\Register\registercontroller());
$app->mount('/home', new App\Home\homecontroller());
$app->mount('/apartamentos', new App\Apartamentouser\apartamentoscontroller());
$app->mount('/comentarios', new App\Comentarios\comentarioscontroller());
$app->mount('/apartamentosadmin', new App\ApartamentosAdmin\apartamentosadmincontroller());
$app->mount('/formulario', new App\Formulario\Formulariocontroller());


$app['debug'] = true;
$app->run();
