<?php

// Classe Citoyen avec attribut President
class Citoyen {
    private static $president;

    public static function setPresident($president) {
        self::$president = $president;
    }

    public static function getPresident() {
        return self::$president;
    }
}

// MemoClass pour mémoriser les instances
class MemoPile {
    private static $instances = [];

    public function __construct() {
        self::$instances[] = $this;
    }

    public static function instances() {
        return self::$instances;
    }
}

// Classes pour l'université
class SalleCours {
    private static $nbMaxSalles = 5;
    private static $nbSalles = 0;

    public function __construct() {
        if (self::$nbSalles >= self::$nbMaxSalles) {
            throw new Exception("Nombre maximum de salles atteint");
        }
        self::$nbSalles++;
    }
}

// Hiérarchie Animal
abstract class Animal {
    abstract public function faireBruit();
}

class Carnivore extends Animal {
    public function faireBruit() {
        return "Grrr";
    }
}

class Chat extends Carnivore {
    public function faireBruit() {
        return "Miaou";
    }
}

// Tests
echo "Test des classes:\n";

// Test Citoyen
$president = new Citoyen();
Citoyen::setPresident($president);
echo "Président défini: " . (Citoyen::getPresident() !== null ? "Oui" : "Non") . "\n";

// Test MemoPile
$pile1 = new MemoPile();
$pile2 = new MemoPile();
echo "Nombre d'instances MemoPile: " . count(MemoPile::instances()) . "\n";

// Test SalleCours
try {
    for ($i = 0; $i < 6; $i++) {
        new SalleCours();
    }
} catch (Exception $e) {
    echo "Limitation SalleCours: " . $e->getMessage() . "\n";
}

// Test Animal/Chat
$chat = new Chat();
echo "Bruit du chat: " . $chat->faireBruit() . "\n";