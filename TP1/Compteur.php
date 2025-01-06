<?php

class Compteur {
    // Variable d'instance
    private $valeur;

    // Constructeur
    public function __construct($initialValue = 0) {
        $this->valeur = $initialValue;
    }

    // Méthode pour incrémenter la valeur
    public function incrementer() {
        $this->valeur++;
    }

    // Méthode pour obtenir la valeur actuelle
    public function getValeur() {
        return $this->valeur;
    }

    // Méthode pour afficher la valeur
    public function printValeur() {
        echo "La valeur du compteur est : " . $this->valeur . "\n";
    }
}

// Exemple d'utilisation
// $compteur = new Compteur();  // Crée un nouveau compteur avec une valeur initiale de 0
// $compteur->printValeur();    // Affiche la valeur (0)
// $compteur->incrementer();    // Incrémente la valeur
// $compteur->printValeur();    // Affiche la nouvelle valeur (1)
?>
