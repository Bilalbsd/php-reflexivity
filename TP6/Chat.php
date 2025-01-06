<?php

// 1. Définition de la méta-classe MemoClass
class MemoClass {
    private static array $instances = [];

    public function __construct() {
        self::$instances[] = $this;
    }

    public static function getInstances(): array {
        return self::$instances;
    }
}

// 2. Classe Pile qui hérite de MemoClass
class Pile extends MemoClass {
    private array $elements = [];

    public function empiler($element): void {
        $this->elements[] = $element;
    }

    public function depiler() {
        if (empty($this->elements)) {
            throw new RuntimeException("Pile vide");
        }
        return array_pop($this->elements);
    }
}

// 3. Classes pour la hiérarchie Animal/Chien/Chat
abstract class Animal {
    protected string $nom;

    public function __construct(string $nom) {
        $this->nom = $nom;
    }

    abstract public function faireBruit(): string;
}

class Chien extends Animal {
    public function faireBruit(): string {
        return "Woof!";
    }
}

class Chat extends Animal {
    public function faireBruit(): string {
        return "Miaou!";
    }
}

// 4. Inspecteur d'objets
class ObjectInspector {
    public function inspect($object): array {
        $reflection = new ReflectionClass($object);

        return [
            'className' => $reflection->getName(),
            'properties' => $this->getProperties($reflection, $object),
            'methods' => $this->getMethods($reflection)
        ];
    }

    private function getProperties(ReflectionClass $reflection, $object): array {
        $properties = [];
        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);
            $properties[$property->getName()] = $property->getValue($object);
        }
        return $properties;
    }

    private function getMethods(ReflectionClass $reflection): array {
        $methods = [];
        foreach ($reflection->getMethods() as $method) {
            $methods[] = [
                'name' => $method->getName(),
                'isPublic' => $method->isPublic(),
                'parameters' => array_map(
                    fn($param) => $param->getName(),
                    $method->getParameters()
                )
            ];
        }
        return $methods;
    }
}

// Tests de démonstration
function runTests() {
    // Test de MemoClass et Pile
    $pile1 = new Pile();
    $pile1->empiler(1);
    $pile1->empiler(2);

    $pile2 = new Pile();
    $pile2->empiler("a");

    echo "Nombre d'instances de MemoClass: " . count(MemoClass::getInstances()) . "\n";

    // Test des animaux
    $chien = new Chien("Rex");
    $chat = new Chat("Minou");

    echo $chien->faireBruit() . "\n";
    echo $chat->faireBruit() . "\n";

    // Test de l'inspecteur
    $inspector = new ObjectInspector();
    $inspection = $inspector->inspect($chien);

    echo "Inspection de l'objet Chien:\n";
    echo json_encode($inspection, JSON_PRETTY_PRINT) . "\n";
}

// Exécution des tests
runTests();