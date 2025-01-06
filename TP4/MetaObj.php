<?php

class Pile {
    protected $elements = [];

    public function grow() {
        $this->elements[] = count($this->elements) + 1;
    }

    public function push($element) {
        $this->elements[] = $element;
    }

    public function getElements() {
        return $this->elements;
    }
}

class PileGrossissante extends Pile {
    public function grow() {
        parent::grow();
        parent::grow();
    }
}

// Test des piles
$pile = new Pile();
echo "Test Pile standard:\n";
$pile->grow();
$pile->grow();
print_r($pile->getElements());

$pileGross = new PileGrossissante();
echo "\nTest PileGrossissante:\n";
$pileGross->grow();
print_r($pileGross->getElements());

// Test LinkedList
class Node {
    public $value;
    public $next;

    public function __construct($value) {
        $this->value = $value;
        $this->next = null;
    }
}

class LinkedList {
    private $head;

    public function add($value) {
        $node = new Node($value);
        if (!$this->head) {
            $this->head = $node;
            return;
        }
        $current = $this->head;
        while ($current->next) {
            $current = $current->next;
        }
        $current->next = $node;
    }

    public function display() {
        $current = $this->head;
        while ($current) {
            echo $current->value . " -> ";
            $current = $current->next;
        }
        echo "null\n";
    }
}

echo "\nTest LinkedList:\n";
$list = new LinkedList();
$list->add(1);
$list->add(2);
$list->add(3);
$list->display();