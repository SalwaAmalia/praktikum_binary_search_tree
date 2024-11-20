<?php
class TreeNode {
    public $value;
    public $left;
    public $right;

    public function __construct($value) {
        $this->value = $value;
        $this->left = null;
        $this->right = null;
    }
}

class PredictionTree {
    public $root;

    public function __construct() {
        $this->root = null;
    }

    public function addPrediction($value) {
        $newNode = new TreeNode($value);
        if ($this->root === null) {
            $this->root = $newNode;
        } else {
            $this->insertNode($this->root, $newNode);
        }
    }

    private function insertNode($node, $newNode) {
        if ($newNode->value < $node->value) {
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

    public function displayPredictions($node) {
        if ($node !== null) {
            $this->displayPredictions($node->left);
            echo "Prediction Accuracy: " . $node->value . "%\n";
            $this->displayPredictions($node->right);
        }
    }
}
$modelTree = new PredictionTree();

$modelTree->addPrediction(78.5);
$modelTree->addPrediction(85.3);
$modelTree->addPrediction(90.4);
$modelTree->addPrediction(80.1);

$modelTree->displayPredictions($modelTree->root);

?>
