<?php
try{
    require_once(__DIR__."/MyReservation.php");
    $N = $_REQUEST["N"];
    file_put_contents("debug.log","N".$N);
    $myReservation = new \Src\MyReservation();
    $myReservation->setN($N);
    $myData = $myReservation->checkDates(30);
    echo json_encode(["result"=>"success","data"=>$myData]);
}
catch(Throwable $e)
{
     echo json_encode(["result"=>"error","data"=>$e->getMessage()." ". $e->getLine()]);
}
?>