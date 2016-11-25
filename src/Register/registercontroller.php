<?php

namespace App\Register;

require "generated-conf/config.php";
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Propel\Runtime\Propel;
use Propel\Runtime\Adapter;
use Personas;
use Usuarios;

class registercontroller implements ControllerProviderInterface
{

  public function connect(Application $app)
  {
   
    $controller = $app['controllers_factory'];

    $controller->get('/register', function() use($app) {

      return $app['twig']->render('registrar.html.twig');

    })->bind('register');
    
    $controller->post('/doregister', function() use($app) {
      
      $nombre=$_POST['nombre'];
      $apellido=$_POST['apellido'];
      $identificacion=$_POST['identificacion'];
      $correo=$_POST['correo'];
      $user=$_POST['usuario'];
      $pass=$_POST['password'];
      
      
      
      $usuario= new Usuarios();
      
      $usuario->setLogin($user);
      $usuario->setPassword($pass);
      $usuario->setTipo(0);
      
      $usuario->save();
     
      $persona = new Personas();
      
      $persona->setNombre($nombre);
      $persona->setApellido($apellido);
      $persona->setIdentificacion($identificacion);
      $persona->setCorreoelectronico($correo);
      $persona->setIdUsuario($usuario);
      
      $persona->save();
      
      return $app->redirect( $app['url_generator']->generate('login'));
    
    })->bind('doregister');


    // retorna el controlador
       return $controller;
  }
}

?>