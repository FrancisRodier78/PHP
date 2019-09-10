<?php
/*
Le pattern Singleton a pour but d'assurer qu'une classe ne possède qu'une 
seule instance et de fournir une méthode de classe unique retournant cette 
instance.

Dans certains cas, il est utile de gérer des classes ne possédant qu'une seule ins-
tance. Dans le cadre du patterns de construction, nous pouvons citer le cas
d'une fabrique de produits (patterns Abstract Factory) dont il n'est pas
nécessaire de créer plus d'une instance.
*/

namespace Prototype;
require_once 'Liasse.classe.php';

class LiasseVierge extends Liasse
{
	/**
	* @var LiasseVierge
	*/
    private static $_instance = null;

    private function __construct()
    {
    	$this->documents = new \ArrayObject();
    }

    /**
    *
    * @return LiasseVierge
    */

    public static function Instance()
    {
    	if (!isset(LiasseVierge::$_instance))
    	{
    		LiasseVierge::$_instance = new LiasseVierge();
    	}
    	return LiasseVierge::$_instance;
    }
}

?>
