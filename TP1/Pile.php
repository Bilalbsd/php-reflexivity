<?php

class Pile {
    // Variables d'instance
    private $contenu;
    private $index;
    private $capacite;

    // Variable statique
    private static $tailleDefaut = 10;  // Capacité par défaut

    // Constructeur avec un paramètre pour la taille de la pile
    public function __construct($taille = null) {
        $this->index = 0;
        $this->capacite = $taille ?? self::$tailleDefaut;
        $this->contenu = array();  // Initialisation d'un tableau vide
    }

    // Méthode pour ajouter un élément à la pile
    public function empiler($element) {
        if ($this->index < $this->capacite) {
            $this->contenu[$this->index] = $element;
            $this->index++;
        } else {
            echo "La pile est pleine.\n";
        }
    }

    // Méthode pour retirer un élément de la pile
    public function depiler() {
        if ($this->index > 0) {
            $this->index--;
            return array_pop($this->contenu);
        } else {
            echo "La pile est vide.\n";
            return null;
        }
    }

    // Méthode pour vérifier si la pile est vide
    public function estVide() {
        return $this->index === 0;
    }

    // Méthode pour afficher l'état actuel de la pile
    public function afficherPile() {
        echo "Éléments de la pile: " . implode(", ", $this->contenu) . "\n";
    }
}

// Exemple d'utilisation
// $pile = new Pile(5);  // Crée une pile avec une capacité de 5 éléments
// $pile->empiler(1);
// $pile->empiler(2);
// $pile->empiler(3);
// $pile->afficherPile();  // Affiche les éléments de la pile
// $pile->depiler();       // Retire le dernier élément
// $pile->afficherPile();  // Affiche la pile après le retrait
?>
