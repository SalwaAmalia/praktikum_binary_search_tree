<?php
class SensorNode {
    public $sensorID;
    public $temperature;
    public $left;
    public $right;

    public function __construct($sensorID, $temperature) {
        $this->sensorID = $sensorID;
        $this->temperature = $temperature;
        $this->left = null;
        $this->right = null;
    }
}

class SensorDataTree {
    public $root;

    public function __construct() {
        $this->root = null;
    }

    public function addSensorData($sensorID, $temperature) {
        $newNode = new SensorNode($sensorID, $temperature);
        if ($this->root === null) {
            $this->root = $newNode;
        } else {
            $this->insertNode($this->root, $newNode);
        }
    }
    private function insertNode($node, $newNode) {
        if ($newNode->temperature < $node->temperature) {
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

    public function searchByTemperature($temperature) {
        return $this->searchNode($this->root, $temperature);
    }

    private function searchNode($node, $temperature) {
        if ($node === null) {
            return null; 
        }

        if ($temperature === $node->temperature) {
            return $node; 
        } elseif ($temperature < $node->temperature) {
            return $this->searchNode($node->left, $temperature);
        } else {
            return $this->searchNode($node->right, $temperature);
        }
    }
}

$sensorTree = new SensorDataTree();

$sensorTree->addSensorData(101, 22.5);
$sensorTree->addSensorData(102, 19.8);
$sensorTree->addSensorData(103, 25.1);
$sensorTree->addSensorData(104, 23.4);

$searchTemp = 23.4;
$foundNode = $sensorTree->searchByTemperature($searchTemp);

if ($foundNode !== null) {
    echo "Sensor with ID " . $foundNode->sensorID . " has a temperature of " . $foundNode->temperature . "\n";
} else {
    echo "No sensor data found for temperature " . $searchTemp . "\n";
}
?>
