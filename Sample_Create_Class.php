<?php
$hold = array();
$car = new car();
$car->Age="12";
$car->Name="ramin";
array_push($hold,"salam");

$car->players=$hold;
$myJSON = json_encode($car);
// $myClub->populatePlayers();
// var_dump($myClub->players);
echo $myJSON;
exit();

var_dump($car);

class Car {
    public $Age;
    public $Name;
    var $players=array();
    
//     function __constructor($clubID = '') {              
//         $this->clubID = $clubID;
// } 

// function populatePlayers() {    
//         $this->players[] = 'Tom';
// }        


  }


?>