<?php

// Inclusion des fichiers de classes
require_once 'Compteur.php';  // Inclut la classe Compteur
require_once 'Pile.php';      // Inclut la classe Pile

// --- TESTS ---
// Test de la classe Compteur
echo "Test de la classe Compteur:\n";
$compteur = new Compteur();  // Crée un compteur avec une valeur initiale de 0
$compteur->printValeur();    // Affiche la valeur (0)
$compteur->incrementer();    // Incrémente la valeur
$compteur->printValeur();    // Affiche la nouvelle valeur (1)
$compteur->incrementer();    // Incrémente encore
$compteur->printValeur();    // Affiche la nouvelle valeur (2)

echo "\n";

// Test de la classe Pile
echo "Test de la classe Pile:\n";
$pile = new Pile(5);  // Crée une pile avec une capacité de 5 éléments
$pile->empiler(1);
$pile->empiler(2);
$pile->empiler(3);
$pile->afficherPile();  // Affiche les éléments de la pile
$pile->depiler();       // Retire le dernier élément
$pile->afficherPile();  // Affiche la pile après le retrait
$pile->empiler(4);
$pile->empiler(5);
$pile->empiler(6);      // Essaye d'ajouter un élément alors que la pile est pleine
$pile->afficherPile();  // Affiche la pile après avoir ajouté un autre élément

?>
