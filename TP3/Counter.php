<?php

// Implémentation de la classe Counter avec une fermeture
class Counter {
    // Méthode de classe pour créer une fermeture avec un compteur
    public static function create() {
        $x = 0;
        return function() use (&$x) {
            $x++;
            return $x;
        };
    }
}

// Classe pour étendre les booléens avec de nouvelles méthodes de contrôle
class BooleanExtensions {
    // Méthode ifNotTrue pour les booléens
    public static function ifNotTrue($condition, $closure) {
        if (!$condition) {
            return $closure();
        }
        return null;
    }

    // Méthode ifNotFalse pour les booléens
    public static function ifNotFalse($condition, $closure) {
        if ($condition !== false) {
            return $closure();
        }
        return null;
    }
}

// Extension de la classe Closure pour ajouter repeatUntil
class ClosureExtensions {
    // Méthode repeatUntil
    public static function repeatUntil(Closure $closure, Closure $condition) {
        do {
            $closure();
        } while (!$condition());
    }
}

// Classe Object pour ajouter des méthodes d'introspection
class ObjectIntrospection {
    // Méthode générique d'inspection d'objets
    public function exoInspect() {
        $reflection = new ReflectionObject($this);
        $properties = $reflection->getProperties();

        $result = [];
        foreach ($properties as $property) {
            $property->setAccessible(true);
            $name = $property->getName();
            $value = $property->getValue($this);

            // Conversion de la valeur en chaîne de caractères
            if (is_array($value)) {
                $value = print_r($value, true);
            } elseif (is_object($value)) {
                $value = get_class($value);
            } elseif (is_null($value)) {
                $value = 'null';
            }

            $result[] = "$name: $value";
        }

        return implode("\n", $result);
    }
}

// Exemple de démonstration
class DemoTP3 {
    public static function demonstrateFermetures() {
        // Création de deux fermetures
        $lambda1 = Counter::create();
        $lambda2 = Counter::create();

        // Appels des fermetures
        echo "Lambda 1 première exécution: " . $lambda1() . "\n";
        echo "Lambda 1 deuxième exécution: " . $lambda1() . "\n";
        echo "Lambda 2 première exécution: " . $lambda2() . "\n";
        echo "Lambda 2 deuxième exécution: " . $lambda2() . "\n";

        // Démonstration des méthodes étendues
        BooleanExtensions::ifNotTrue(false, function() {
            echo "Cette fermeture s'exécute car la condition est false\n";
        });

        ClosureExtensions::repeatUntil(
            function() { echo "Répétition\n"; },
            function() { static $count = 0; return ++$count > 3; }
        );
    }
}

// Classe de test pour l'introspection
class IntrospectionTest extends ObjectIntrospection {
    private $contenu = [33, null, null, null];
    private $index = 1;
    private $capacite = 4;
}

// Exécution des démonstrations
DemoTP3::demonstrateFermetures();

// Test d'introspection
$test = new IntrospectionTest();
echo "\nIntrospection de l'objet :\n";
echo $test->exoInspect();