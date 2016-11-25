<?php
namespace App\Formulario;


require "generated-conf/config.php";
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Propel\Runtime\Propel;
use Propel\Runtime\Adapter;
use Tipos;
use Apartamentos;
use Base\ApartamentosQuery;
use Base\TiposQuery;




class Formulariocontroller implements ControllerProviderInterface
{
  
  public function connect(Application $app)
  {
    
    $controller = $app['controllers_factory'];
   
    $controller->get('/formulario', function() use($app) {
     
     
    $arra=array(
     
     'id'=>0,
     'direccion'=>'',
     'descripcion'=>'',
     'precio'=>'',
     'nombre'=>'',
     'latitud'=>'',
     'longitud'=>''
     
     );
    
    
     return $app['twig']->render('formularioadmin.html.twig', array(
      
      'array'=>$arra
      
      ));
 
     
    })->bind('formulario');
    
     $controller->post('/doregistro', function() use($app) {

   $direccion=$_POST['direccion'];
   $descripcion=$_POST['descripcion'];
   $nombre=$_POST['tipo'];
   $latitud=$_POST['latitud'];
   $longitud=$_POST['longitud'];
   $precio=$_POST['precio'];
   $id=$_POST['id'];
   
   if($id==0){
   
    $tipo = TiposQuery::create()->filterByNombre($nombre)->find();
    
    $apartamento = new Apartamentos();
    
    $apartamento->setDireccion($direccion);
    $apartamento->setDescripcion($descripcion);
    $apartamento->setLatitud($latitud);
    $apartamento->setPrecio($precio);
    $apartamento->setIdTipo($tipo[0]->getId());
    $apartamento->setLongitud($longitud);
   
    $apartamento->save();
     
     
    return $app->redirect( $app['url_generator']->generate('apartamentosadmin'));
     
   }else{
    
    $apar = ApartamentosQuery::create()->findPK($id);
    
     $tipo = TiposQuery::create()->filterByNombre($nombre)->find();
    
    $apar->setDireccion($direccion);
    $apar->setDescripcion($descripcion);
    $apar->setLatitud($latitud);
    $apar->setPrecio($precio);
    $apar->setIdTipo($tipo[0]->getId());
    $apar->setLongitud($longitud);
    
    $apar->save();
    
     return $app->redirect( $app['url_generator']->generate('apartamentosadmin'));
    
   }
     
    })->bind('doregistro');
    
     $controller->post('/updateapartamento', function() use($app) {
       
       $id=$_POST['id'];
       
      $apartamento = ApartamentosQuery::create()->findPK($id);
      
       $tipo = TiposQuery::create()->findPK($apartamento->getIdTipo());

     
           $apar= array(
      
          'id'=> $apartamento->getId(),
          'direccion'=>$apartamento->getDireccion(),
          'descripcion'=>$apartamento->getDescripcion(),
          'precio'=>$apartamento->getPrecio(),
          'nombre'=>$tipo->getNombre(),
          'latitud'=>$apartamento->getLatitud(),
          'longitud'=>$apartamento->getLongitud()
           
        
          );
      
          return $app['twig']->render('formularioadmin.html.twig',array(
        
        'array'=>$apar
        
        ));
   
     
    })->bind('updateapartamento');
    
 
       return $controller;
  }
  
  
}    