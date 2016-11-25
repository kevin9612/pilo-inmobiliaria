<?php
require "vendor/autoload.php";
require "generated-conf/config.php";
use Propel\Runtime\Propel;

/*
$usuario = new Usuarios();
$usuario->setLogin("juan");
$usuario->setPassword("1234");

$usuario->save();
*/
/*
  
    $con = Propel::getConnection();
    $sql = "select * from usuarios where login='juan' and password='1234'";
    $statement=$con->prepare($sql);
    
    $statement->execute();
    
    $formatter = new ObjectFormatter();
    $formatter->setClass('Usuarios');
    $usuarios = $formatter->format($statement);
    
    foreach ($usuarios as $usuario) {
    echo $usuario->getLogin()."\n";
}*/

$login="juan";
$password="1234";
$usuarios = UsuariosQuery::create()->where("usuarios.login='".$login."'and usuarios.password=?",$password)->find();
foreach ($usuarios as $usuario) {
    echo $usuario->getLogin()."\n";
}

/*
$elusuario = UsuariosQuery::create()->findPK(1);
echo $elusuario->getLogin()."\n";*/