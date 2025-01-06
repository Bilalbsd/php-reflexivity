<?php
use PHPUnit\Framework\TestCase;

require_once 'Pile.php';  // Assurez-vous d'inclure la définition de la classe Pile

class PileTest extends TestCase {
    /**
     * Test de la création d'une pile avec taille par défaut
     */
    public function testCreationPileDefaut() {
        $pile = new Pile();
        $this->assertTrue($pile->isEmpty());
        $this->assertFalse($pile->isFull());
    }

    /**
     * Test de la création d'une pile avec une taille personnalisée
     */
    public function testCreationPilePersonnalisee() {
        $pile = new Pile(10);
        $this->assertTrue($pile->isEmpty());
        $this->assertFalse($pile->isFull());
    }

    /**
     * Test de l'ajout d'éléments dans la pile
     */
    public function testPush() {
        $pile = new Pile(3);

        $pile->push(1);
        $this->assertFalse($pile->isEmpty());
        $this->assertEquals(1, $pile->top());

        $pile->push('test');
        $this->assertEquals('test', $pile->top());
    }

    /**
     * Test de la méthode pop()
     */
    public function testPop() {
        $pile = new Pile(3);
        $pile->push(1);
        $pile->push(2);

        $this->assertEquals(2, $pile->pop());
        $this->assertEquals(1, $pile->top());
    }

    /**
     * Test des exceptions lors de l'ajout dans une pile pleine
     */
    public function testPushPilePleine() {
        $pile = new Pile(2);
        $pile->push(1);
        $pile->push(2);

        $this->expectException(Exception::class);
        $pile->push(3);
    }

    /**
     * Test des exceptions lors du pop() sur une pile vide
     */
    public function testPopPileVide() {
        $pile = new Pile();

        $this->expectException(Exception::class);
        $pile->pop();
    }

    /**
     * Test de la méthode top() sur une pile vide
     */
    public function testTopPileVide() {
        $pile = new Pile();

        $this->expectException(Exception::class);
        $pile->top();
    }

    /**
     * Test de la méthode grow() pour augmenter la capacité
     */
    public function testGrow() {
        $pile = new Pile(2);
        $pile->push(1);
        $pile->push(2);

        // Utilisation de la réflexion pour vérifier la capacité privée
        $reflexion = new ReflectionClass($pile);
        $proprieteCapacite = $reflexion->getProperty('capacite');
        $proprieteCapacite->setAccessible(true);
        $ancienneCapacite = $proprieteCapacite->getValue($pile);

        $pile->grow();

        $nouvelleCapacite = $proprieteCapacite->getValue($pile);
        $this->assertEquals($ancienneCapacite * 2, $nouvelleCapacite);
    }

    /**
     * Test de la conversion en chaîne
     */
    public function testToString() {
        $pile = new Pile(3);
        $pile->push(1);
        $pile->push('test');

        $this->assertStringContainsString('une Pile', (string)$pile);
        $this->assertStringContainsString('1 test', (string)$pile);
    }

    /**
     * Test de l'initialisation statique
     */
    public function testInitialize() {
        Pile::initialize();

        // Création d'une pile sans paramètre devrait avoir la taille par défaut
        $pile = new Pile();
        $reflexion = new ReflectionClass($pile);
        $proprieteCapacite = $reflexion->getProperty('capacite');
        $proprieteCapacite->setAccessible(true);
        $capacite = $proprieteCapacite->getValue($pile);

        $this->assertEquals(5, $capacite);
    }
}