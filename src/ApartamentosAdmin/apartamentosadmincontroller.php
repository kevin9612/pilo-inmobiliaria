<?php
namespace App\ApartamentosAdmin;


require "generated-conf/config.php";
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Propel\Runtime\Propel;
use Propel\Runtime\Adapter;
use Apartamentos;
use Base\ApartamentosQuery;
use Base\ComentariosQuery;
use Tipos;
use Base\TiposQuery;




class apartamentosadmincontroller implements ControllerProviderInterface
{
  
  public function connect(Application $app)
  {
    
    $controller = $app['controllers_factory'];
   
    $controller->get('/apartamentos', function() use($app) {
 
     $apartamento = ApartamentosQuery::create()->find();

        foreach($apartamento as $a){
      
        $tipo = TiposQuery::create()->findPK($a->getIdTipo());
       
            
        $apar []= array(
      
          'id'=> $a->getId(),
          'direccion'=>$a->getDireccion(),
          'descripcion'=>$a->getDescripcion(),
          'precio'=>$a->getPrecio(),
          'nombre'=>$tipo->getNombre(),
          'latitud'=>$a->getLatitud(),
          'longitud'=>$a->getLongitud()
           
        
          );
              }
              
          return $app['twig']->render('apartamentosadmin.html.twig',array(
        
        'apar'=>$apar
        
        ));

    })->bind('apartamentosadmin');
 
     $controller->post('/deleteapartamento', function() use($app) {
         
         $id=$_POST['id'];
        
        $apartamento = ApartamentosQuery::create()->findPK($id);  
        
        $comentario = ComentariosQuery::create()->filterByIdApartamento($id)->find();
        
        foreach($comentario as $coment){
          
          $coment->delete();
          
        }
        
        $apartamento->delete(); 
        
        
        
        
         return $app->redirect( $app['url_generator']->generate('apartamentosadmin'));
         
     })->bind('deleteapartamento');
 
       
       return $controller;
  }
}    
