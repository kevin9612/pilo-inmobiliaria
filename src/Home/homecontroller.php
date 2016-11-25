<?php
namespace App\Home;


require "generated-conf/config.php";
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Propel\Runtime\Propel;
use Propel\Runtime\Adapter;
use Base\Usuarios;
use Base\UsuariosQuery;




class homecontroller implements ControllerProviderInterface
{
  
  public function connect(Application $app)
  {
    
    $controller = $app['controllers_factory'];
   
    $controller->get('/home', function() use($app) {

     $user=$app['session']->get('user');
     
      if(isset( $user ) && $user != '' ){

      return $app['twig']->render('home.html.twig', array(
        
        'user'=>$user
        
      ));
      
      }else{
        
        return $app['twig']->render('home.html.twig', array(
        
        'user'=>$user
        
      ));
        
      }
     
    })->bind('home');
 
     $controller->get('/homeadmin', function() use($app) {

      return $app['twig']->render('homeadmin.html.twig');
     
    })->bind('homeadmin');
 
    
       return $controller;
  }
}    