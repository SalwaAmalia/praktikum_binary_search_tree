<?php
class DataNode {
    public $id;
    public $left;
    public $right;

    public function __construct($id) {
        $this->id = $id;
        $this->left = null;
        $this->right = null;
    }
}
class DataTree {
    public $root;

    public function __construct() {
        $this->root = null;
    }

    public function addData($id) {
        $newNode = new DataNode($id);
        if ($this->root === null) {
            $this->root = $newNode;
        } else {
            $this->insertNode($this->root, $newNode);
        }
    }

    private function insertNode($node, $newNode) {
        if ($newNode->id < $node->id) {
            if ($node->left === null) {
                $node->left = $newNode;
            } else {
                $this->insertNode($node->left, $newNode);
            }
        } else {
            if ($node->right === null) {
                $node->right = $newNode;
            } else {
                $this->insertNode($node->right, $newNode);
            }
        }
    }

    public function searchData($id) {
        return $this->searchNode($this->root, $id);
    }

    private function searchNode($node, $id) {
        if ($node === null) {
            return false; 
        }

        if ($id === $node->id) {
            return true; 
        } elseif ($id < $node->id) {
            return $this->searchNode($node->left, $id);
        } else {
            return $this->searchNode($node->right, $id);
        }
    }
}

$dataTree = new DataTree();

$dataTree->addData(101);
$dataTree->addData(205);
$dataTree->addData(50);
$dataTree->addData(300);

$searchID = 150;
if ($dataTree->searchData($searchID)) {
    echo "Data with ID $searchID found in the tree.\n";
} else {
    echo "Data with ID $searchID not found.\n";
}
?>
