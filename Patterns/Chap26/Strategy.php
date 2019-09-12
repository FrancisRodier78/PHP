<?php
/*
Le pattern Strategy a pour objectif d'adapter le comportement et les algo-
rithmes d'un objet en fonction d'un besoin sans changer les interaction de cet
objet avec les clients.

Ce besoin peut relever de plusieurs aspects comme des aspects de présentta-
tion, d'efficacité en temps ou en mémoire, de choix d'algorithmes, de repré-
sentation interne, etc. Mais évidemment, il ne s'agit pas d'un besoin 
fonctionnel vis-à-vis des clients de l'objet car les interaction de l'objet et
ses clients doivent rester inchangées.
*/

namespace strategy;

require_once 'ListeVueVehicule.class.php';

interface DessinCatalogue
{
	/**
	*
	* @param ListeVueVehicuke $contenu
	*/
	function dessine(ListeVueVehicuke $contenu);
}
?>

<?php
namespace strategy;

require_once 'VueVehicule.class.php';

class ListeVueVehicuke implements \IteratorAggregate
{
	/**
	*
	* @var \arrayObject
	*/
	Private $vueVehicule;

	public function __construct()
	{
		$this->vuesVehicule = new \$arrayObject();
	}

	public function append (VueVehicule $value)
	{
		$this->vuesVehicule->append($value);
	}

	public function getIterator()
	{
		return $this->vueVehicule->getIterator();
	}
}
?>

<?php
namespace strategy;

require_once 'DessinCatalogue.class.php';
require_once 'ListeVueVehicule.class.php';
require_once '../Outils.class.php';

class DessinUnVehiculeLigne implements DessinCatalogue
{
	/* code */
}

?>

<?php
namespace strategy;

require_once 'DessinCatalogue.class.php';
require_once 'ListeVueVehicule.class.php';
require_once '../Outils.class.php';

class DessinTroisVehiculesLigne implements DessinCatalogue
{
	/* code */
}

?>

<?php
namespace strategy;

require_once '../Outils.class.php';

class VueVehicule
{
	/* code */
}
?>

<?php
namespace strategy;

require_once 'DessinCatalogue.class.php';
require_once 'VueVehicule.class.php';
require_once 'ListeVueVehicule.class.php';

class VueCatalogue
{
	/* code */
}
?>

<?php
namespace strategy;

require_once 'VueCatalogue.class.php';
require_once 'DessinTroisVehiculesLigne.class.php';
require_once 'DessinUnVehiculeLigne.class.php';

$VueCatalogue1 = new VueCatalogue(new DessinTroisVehiculesLigne());
$VueCatalogue1->dessine();

$VueCatalogue2 = new VueCatalogue(new DessinUnVehiculesLigne());
$VueCatalogue2->dessine();
?>
