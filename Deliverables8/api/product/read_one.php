<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$product = new Product($db);
  
// set ID property of record to read
$product->modelnumber = isset($_GET['modelnumber']) ? $_GET['modelnumber'] : die();
  
// read the details of product to be edited
$product->readOne();
  
if($product->modelnumber!=null){
    // create array
    $product_arr = array(
         "modelnumber"=>$modelnum,
		   "pname" => $pname,
           "celltech"=>$celltech,
		   "cellman" => $cellman,
           "numcels"=>$numcels,
		   "cellseries" => $cellseries,
           "numdio"=>$numdio,
		   "len" => $len,
           "width"=>$width,
		   "weight" => $weight,
           "superstate"=>$superstate,
		   "superman"=>$superman,
		   "substratetype" => $substratetype,
           "subman"=>$subman,
		   "frametype" => $frametype,
           "frameadhesive"=>$frameadhesive,
		   "encapsulate" => $encapsulate,
           "encapman"=>$encapman,
		   "junctionboxtype" => $junctionboxtype,
           "junctionboxman"=>$junctionboxman	
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($product_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>