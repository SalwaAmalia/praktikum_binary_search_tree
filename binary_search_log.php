<?php
class LogNode {
    public $timestamp;
    public $message;
    public $left;
    public $right;

    public function __construct($timestamp, $message) {
        $this->timestamp = $timestamp;
        $this->message = $message;
        $this->left = null;
        $this->right = null;
    }
}

class LogTree {
    public $root;

    public function __construct() {
        $this->root = null;
    }

    public function addLog($timestamp, $message) {
        $newNode = new LogNode($timestamp, $message);
        if ($this->root === null) {
            $this->root = $newNode;
        } else {
            $this->insertNode($this->root, $newNode);
        }
    }
    private function insertNode($node, $newNode) {
        if ($newNode->timestamp < $node->timestamp) {
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

    public function searchLog($timestamp) {
        return $this->searchNode($this->root, $timestamp);
    }

    private function searchNode($node, $timestamp) {
        if ($node === null) {
            return null; 
        }

        if ($timestamp === $node->timestamp) {
            return $node; 
        } elseif ($timestamp < $node->timestamp) {
            return $this->searchNode($node->left, $timestamp);
        } else {
            return $this->searchNode($node->right, $timestamp);
        }
    }
}

$logTree = new LogTree();

$logTree->addLog(1618305000, "Server 1 started");
$logTree->addLog(1618305050, "Server 2 started");
$logTree->addLog(1618318000, "Database connection established");
$logTree->addLog(1618320000, "User login attempt");

$searchTime = 1618305000;
$foundLog = $logTree->searchLog($searchTime);

if ($foundLog !== null) {
    echo "Log found: " . $foundLog->message . " at " . $foundLog->timestamp . "\n";
} else {
    echo "No log found for timestamp " . $searchTime . "\n";
}
?>
