<?php

class Car {

    var $wheels = 4;
    var $hood = 1;
    var $doors = 4;
    var $engine = 1;

    function MoveWheels() {
        echo "Wheels moving";
    }



}

$bmw = new Car();

$bmw->MoveWheels();
?>