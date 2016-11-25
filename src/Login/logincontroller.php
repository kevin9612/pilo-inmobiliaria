<?php
namespace App\Login;


require "generated-conf/config.php";
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Propel\Runtime\Propel;
use Propel\Runtime\Adapter;
use Base\Usuarios;
use Base\UsuariosQuery;




class LoginController implements ControllerProviderInterface
{
  
  public function connect(Application $app)
  {
    
    $controller = $app['controllers_factory'];
   
    $controller->get('/login', function() use($app) {
      
      return $app['twig']->render('login.html.twig',array(
        
        'direccion'=>'home',
        'com'=>''
        
        ));
     
    })->bind('login');

   $controller->post('/dologin', function() use($app) {
  

    $user=$_POST['usuario'];
    $password=$_POST['password'];
    $direccion=$_POST['direccion'];
    $id=$_POST['id'];
    

    
    $usua = UsuariosQuery::create()->where("usuarios.login='".$user."'and usuarios.password=?",$password)->find();

    if(count($usua)==0){
      
          return $app['twig']->render('login.html.twig');
      
    }else{
      
      $tipo=" ";
      
      foreach($usua as $usuario){
        
        if($usuario->getTipo()==1){
          
          $tipo="admin";
          
        }
        
      }
      
      if($tipo=="admin"){
        
           return $app->redirect( $app['url_generator']->generate('homeadmin'));
       
        
        
      }else{
        
      
        $app['session']->set('user',$user);
        $app['session']->set('id',$id);
        
       if($direccion=="comentario"){
      
        
         return $app->redirect( $app['url_generator']->generate('comentarios'));
         
        }else{
          
          if($direccion=="home"){
            return $app->redirect( $app['url_generator']->generate('home'));
          
          }
        }
        
        
      }
      
     
      
    }
    })->bind('dologin');
    
      $controller->post('/logout', function() use($app) {

       $app['session']->set('user','');

     return $app->redirect( $app['url_generator']->generate('home'));
     
    })->bind('logout');
 
    
       return $controller;
  }
}    
