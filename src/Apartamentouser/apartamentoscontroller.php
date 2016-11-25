<?php
namespace App\Apartamentouser;


require "generated-conf/config.php";
use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Propel\Runtime\Propel;
use Propel\Runtime\Adapter;
use Base\Apartamentos;
use Base\ApartamentosQuery;
use Base\Tipos;
use Base\TiposQuery;




class apartamentoscontroller implements ControllerProviderInterface
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
              
          return $app['twig']->render('apartamentosuser.html.twig',array(
        
        'apar'=>$apar
        
        ));
       
    })->bind('apartamentos');
 
   
        $controller->post('/mapaapartamentos', function() use($app) {
          
          $id=$_POST['id'];
          
          $apartamento=ApartamentosQuery::create()->findPK($id);
          
          $array=array(
            
          'latitud'=>$apartamento->getLatitud(),
        'longitud'=>$apartamento->getLongitud()
            
            );

      return $app['twig']->render('mapa.html.twig',array(
        
        'arra'=>$array
        
        ));
     
    })->bind('mapaapartamentos');
       
       return $controller;
  }
}    
