<?php namespace controllers;
class productController {
    public function __construct() {
    }
    public function index() {
        require (ROOT . 'views/product.php');
    }
    public function search($search_product){
    	mysql_connect("localhost","root","");
    	mysql_select_db("ticketmaster");
    	if(isset($search_product)){
    	$search_product = preg_replace("#[^0-9a-z]#i", "", $search_product);
    	$query = mysql_query("SELECT * FROM eventos WHERE title_event LIKE '%$search_product%'");
    	$count = mysql_num_rows($query);
    	if($count == 0){
    		echo "No se encontro nada";
    	}else{
    		while ($row = mysql_fetch_array($query)) { $nombre = $row['title_event'];
    		echo "<pre>";
    		echo $nombre;
    		echo "</pre>";
    		}
    	}
    	}
    }

    

}
