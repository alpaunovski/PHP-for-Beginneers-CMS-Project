<?php

class Car {

    var $wheels = 4;
    var $hood = 1;
    var $doors = 4;
    var $engine = 1;

    function MoveWheels() {
        echo "Wheels moving";
    }


    function __construct() {
        $this->wheels = 10;
    }
}

$bmw = new Car();
echo $bmw->wheels;
