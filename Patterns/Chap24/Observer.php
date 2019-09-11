<?php
/*
Le pattern Observer a pour objectif de construire une dépendance entre un
sujet et des observateurs de sorte que chaque modification du sujet soit noti-
fiée aux observateurs afin qu'ils puissent mettre à jour leur état.
*/

namespace State;

require_once 'CommandeEnCours.class.php';
require_once 'Produit.class.php';
require_once 'ListeProduit.class.php';
require_once '../Outils.class.php';

/**
 * 
 */
class ClassCommande
{
	/**
	* @var ListeProduit
	*/
	protected $produits;

	/**
	* @var EtatCommande
	*/
	protected $etatCommande;

	public function __construct()
	{
		$this->produits = new ListeProduit();
		$this->etatCommande = new CommandeEnCours;
	}

	/**
	* @param Produit $produit
	*/
	public function ajouteProduit(Produit $produit)
	{
		$this->etatCommande->ajouteProduit($produit);
	}

	/**
	* $param Produit $produit
	*/
	public function retireProduit(Produit $produit)
	{
		$this->etatCommande->retireProduit($produit);
	}

	public function efface()
	{
		$this->etatCommande->efface();
	}

	public function etatsuivant()
	{
		$this->etatCommande = $this->etatCommande->etatsuivant();
	}

	/**
	* @return ListeProduit
	*/
	public function getProduit()
	{
		return $this->produits;
	}

	public function affiche()
	{
		\Outils::println('Contenue de la commande');
		foreach ($this->produits as $produit)
		{
			$produit->affiche();
		}
		\Outils::println();
	}
}
?>

<?php
namespace State;

require_once 'Produit.class.php';

class ListeProduit implements \IteratorAggregate
{
	/**
	* @var \ArrayObject
	*/
	protected $produit;

	public function __construct() 
	{
		$this->produits = new \ArrayObject();
	}

	/**
	* @param Produit $produit
	*/
	public function add(Produit $produit) 
	{
		$this->produits->append($produit);
	}

	/**
	* 
	*/
	public function clear()	
	{
		$this->produits = new \ArrayObject();
	}

	/**
	* @param Produit $produit
	*/
	public function remove(Produit $produit)
	{
		foreach ($this->produits as $key => $val) {
			if ($val == $produit) {
				$this->produit->offsetUnset($key);
				break;
			}
		}
	}

	public function getIterator()
	{
		return $this->produits->getIterator();
	}
}
?>

<?php
namespace State;

require_once 'Commande.class.';
require_once 'Produit.class.php';

abstract class EtatCommande
{
	/**
	* @var Commande
	*/
	protected $commande;

	/**
	* @param Commande $commande
	*/
	public function __construct(Commande $commande)
	{
		$this->commande = $commande;
	}

	/**
	* @param Produit $produit
	*/
	public abstract function ajouterProduit(Produit $produit);

	/**
	* @return void
	*/
	public abstract function efface();

	/**
	* @param Produit $produit
	*/
	public abstract function retireProduit(Produit $produit);

	/**
	* @return EtatCommande
	*/
	public abstract function etatSuivant();
}
?>

<?php
namespace State;

require_once 'Commande.class.php';
require_once 'Produit.class.php';
require_once 'EtatCommande.class.php';
require_once 'CommandeValidee.class.php';

class CommandeEnCours extends EtatCommande
{
	/**
	* @param Commande $commande
	*/
	public function __construct(Commande $commande)	
	{
		parent::__construct($commande);
	}

	public function ajouteProduit(Produit $produit)
	{
		$this-commande->getProduits()->add($produit);
	}

	public function retireProduit(Produit $produit)
	 {
		$this-commande->getProduits()->remove(produit)	 	;
	 }

	 public function etatSuivant()
	 {
	 	return new CommandeValidee($this->commande);
	 }
}
?>

<?php
namespace State;

require_once 'Commande.class.php';
require_once 'Produit.class.php';
require_once 'EtatCommande.class.php';
require_once 'CommandeValidee.class.php';

class CommandeValidee extends EtatCommande
{
	/**
	* @param Commande $commande
	*/
	public function __construct(Commande $commande)
	{
		parent::__construct($commande);
	}

	public function ajouteProduit(Produit $produit) {}

	public function efface()
	{
		$this->commande->getProduits()->clear();
	}

	public function retireProduit(Produit $produit) {}

	public function etatSuivant()
	{
		return new CommandeLivree($this->commande);
	}
}
?>

<?php
namespace State;

require_once 'Commande.class.php';
require_once 'Produit.class.php';
require_once 'EtatCommande.class.php';

class Commandelivree extends EtatCommande
{
	/**
	* @param Commande $commande
	*/
	public function __construct(Commande $commande)
	{
		parent::__construct($commande);
	}

	public function efface();

	public function retireProduit(Produit $produit);

	public function etatSuivant()
	{
		return $this;
	}
}
?>

<?php
namespace State;

require_once '../Outils.class.php';
class Produit
{
	/**
	* @var string
	*/
	protected $nom;

	/**
	* @param string $nom
	*/
	public function __construct($nom)
	{
		$this->nom = $nom;
	}

	public function affiche()
	{
		\Outils::println("Produit : $this->nom");
	}
}
?>

<?php
namespace State;

require_once 'Commande.class.php';
require_once 'Produit.class.php';

$commande = new Commande();
$commande->ajouteProduit(new Produit('véhicule 1'));
$commande->ajouteProduit(new Produit('Accessoire 2'));
$commande->affiche();
$commande->etatSuivant();
$commande->ajouteProduit(new Produit('Accessoire3'));
$commande->efface();
$commande->affiche();

$commande2 = new Commande();
$commande2->ajouteProduit(new Produit('véhicule 11'));
$commande2->ajouteProduit(new Produit('Accessoire 21'));
$commande2->affiche();
$commande2->etatSuivant();
$commande2->affiche();
$commande2->etatSuivant();
$commande2->efface();
$commande2->affiche();
?>