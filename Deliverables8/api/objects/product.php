<?php
class Product{
  
    // database connection and table name
    private $conn;
    private $table_name = "product";
  
    // object properties
    public $modelnum;
    public $pname;
    public $celltech;
    public $cellman;
    public $numcels;
    public $cellseries;
    public $numdio;
	public $len;
	public $width;
    public $weight;
    public $superstate;
    public $superman;
    public $substratetype;
    public $subman;
    public $framtype;
	public $frameadhesive;
	public $encapsulate;
    public $encapman;
    public $junctionboxtype;
	public $junctionboxman;
	
	
	
	
	
	
	
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	// read products
function read()
{ 
    $query = "SELECT * FROM product";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}

// used when filling up the update product form
function readOne(){
  
    // query to read single record
    $query = "SELECT
                *
            FROM
                product
              
            WHERE
                modelnum = ?"
           ;
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind modelnumber of product to be updated
    $stmt->bindParam(1, $this->modelnum);
  
    // execute query
    $stmt->execute();
  
  


}

	
}
?>