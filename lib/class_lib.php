<?php 
	class property {
        var $href;
        var $title;
        
        function __construct($new_href,$new_title) {		
            $this->href = $new_href;	
            $this->title = $new_title;		

		}		
 

		function set_href($new_href) {
			$this->href = $new_href;
		}
		function get_href() {
			return $this->href;
        }
        




        function set_title($new_title) {
			$this->title = $new_title;
		}
		function get_title() {
			return $this->title;
        }
        


    }
    






    class RentProperty {
        public $Title;
        public $RentPrice;
        public $Code;
        public $City;
        public $TypeOK;
        
        public $Area;
        public $Bedroom;
        public $Custom1;
        public $Bathroom;
        public $Custom2;
        public $Custom3;
        public $Custom4;
        public $Custom5;
        public $Custom6;
        public $Custom7;
        public $Descr;
        var $imageSlices=array();
        
    //     function __constructor($clubID = '') {              
    //         $this->clubID = $clubID;
    // } 
    
    // function populatePlayers() {    
    //         $this->players[] = 'Tom';
    // }        
    
   
      }

      
   

      class RentProperty6th {
        public $Title;
        public $Descr;
        public $Bedrooms;
        public $Custom;
        public $Custom2;

        public $Area;
        public  $Pricepermonth;
        var $imageSlices=array();
        var $CustomExtraItem=array();
      }

      

?>