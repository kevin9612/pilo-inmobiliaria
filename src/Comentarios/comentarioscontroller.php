<?php
namespace App\Comentarios;


require "generated-conf/config.php";
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Propel\Runtime\Propel;
use Propel\Runtime\Adapter;
use Comentarios;
use Base\ComentariosQuery;




class comentarioscontroller implements ControllerProviderInterface
{
  
  public function connect(Application $app)
  {
    
    $controller = $app['controllers_factory'];
   
    $controller->get('/comentarios', function() use($app) {

   $id=$_REQUEST['id'];

    $user=$app['session']->get('user');
    
    $idsession=$app['session']->get('id');
    
    if(isset( $user ) && $user != '' ){
      
    if(isset( $idsession ) && $idsession != '' ){
      
        $comentario = ComentariosQuery::create()->filterByIdApartamento($idsession)->find();

       foreach($comentario as $comentarios){
      
      $comment[] = array(
        
        'comen'=>$comentarios->getComentarios()
        
        );
   
     
    }
    
        $app['session']->set('id', '');
     
         return $app['twig']->render('comentarios.html.twig', array(
        
         'comentario'=> $comment,
         'id'=>$idsession
        ));    

      
      
    }else{
      
 
      
    $comentario = ComentariosQuery::create()->filterByIdApartamento($id)->find();

    foreach($comentario as $comentarios){
      
      $comment[] = array(
        
        'comen'=>$comentarios->getComentarios()
        
        );
   
     
    }
    
     
         return $app['twig']->render('comentarios.html.twig', array(
        
         'comentario'=> $comment,
         'id'=> $id
        
         
        ));    

      
    }
      
 
      
    }else{

      return $app['twig']->render('login.html.twig', array(
        
        
        'direccion'=>'comentario',
        'com'=>$id
        
        ));
 
    }
    })->bind('comentarios');
 
 $controller->post('/docomentarios', function() use($app) {

    $co=$_POST['comentario'];
    $id=$_POST['id'];

    $comentarios = new Comentarios();


    $comentarios->setComentarios($co);
    $comentarios->setIdApartamento($id);
    
    $comentarios->save();
    
     return $app->redirect( $app['url_generator']->generate('apartamentos'));
     
    })->bind('docomentarios');
 
    
       return $controller;
  }
}    
    