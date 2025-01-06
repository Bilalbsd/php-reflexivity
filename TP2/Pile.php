<?php

class Pile {
    // Propriétés privées
    private $contenu;       // Tableau pour stocker les éléments de la pile
    private $capacite;      // Capacité maximale de la pile
    private $index;         // Index du dernier élément ajouté

    // Variable de classe pour la taille par défaut (équivalent de tailleDefaut en Smalltalk)
    private static $tailleDefaut = 5;

    // Constructeur qui initialise la pile
    public function __construct(int $taille = null) {
        // Si aucune taille n'est fournie, utiliser la taille par défaut
        $this->capacite = $taille ?? self::$tailleDefaut;
        $this->contenu = array_fill(0, $this->capacite, null);
        $this->index = -1;
    }

    // Méthode pour vérifier si la pile est vide
    public function isEmpty(): bool {
        return $this->index === -1;
    }

    // Méthode pour vérifier si la pile est pleine
    public function isFull(): bool {
        return $this->index === $this->capacite - 1;
    }

    // Méthode pour ajouter un élément (push)
    public function push($objet) {
        // Vérifier si la pile est pleine
        if ($this->isFull()) {
            // Option 1 : Lever une exception
            throw new Exception('Pile pleine');

            // Option 2 : Augmenter dynamiquement la taille
            // $this->grow();
        }

        // Incrémenter l'index et ajouter l'objet
        $this->index++;
        $this->contenu[$this->index] = $objet;
    }

    // Méthode pour retirer et retourner l'élément du sommet (pop)
    public function pop() {
        // Vérifier si la pile est vide
        if ($this->isEmpty()) {
            throw new Exception('Pile vide');
        }

        // Récupérer l'élément du sommet
        $element = $this->contenu[$this->index];

        // Réinitialiser l'élément et décrémenter l'index
        $this->contenu[$this->index] = null;
        $this->index--;

        return $element;
    }

    // Méthode pour voir l'élément du sommet sans le retirer
    public function top() {
        if ($this->isEmpty()) {
            throw new Exception('Pile vide');
        }

        return $this->contenu[$this->index];
    }

    // Méthode pour doubler la capacité de la pile
    public function grow() {
        $nouvelleCapacite = $this->capacite * 2;
        $nouveauContenu = array_fill(0, $nouvelleCapacite, null);

        // Copier les éléments existants
        for ($i = 0; $i <= $this->index; $i++) {
            $nouveauContenu[$i] = $this->contenu[$i];
        }

        $this->contenu = $nouveauContenu;
        $this->capacite = $nouvelleCapacite;
    }

    // Méthode magique pour convertir l'objet en chaîne (équivalent de printOn:)
    public function __toString(): string {
        $description = "une Pile, de taille: {$this->capacite} contenant: {$this->index} objets : (";

        for ($i = 0; $i <= $this->index; $i++) {
            $description .= $this->contenu[$i] . " ";
        }

        $description .= ")";
        return $description;
    }

    // Méthode statique pour initialiser les valeurs par défaut
    public static function initialize() {
        self::$tailleDefaut = 5;
    }

    // Méthode statique d'exemple (comme dans le tutoriel Smalltalk)
    public static function exemple() {
        $pile = new Pile();
        $pile->push(33);
        $pile->push("une chaîne");
        echo $pile . "\n";
    }
}

// Exemple d'utilisation
Pile::initialize();  // Initialisation de la taille par défaut
Pile::exemple();     // Exécution de l'exemple