<?php namespace Src;
require_once(__DIR__ . '/../vendor/autoload.php');
use Introvert\Configuration;
use Introvert\ApiClient;
use \DateTime;

class MyReservation{
    private const STATUS_IDS=[
        57230590, // Первый этап
        57230594, // Второй этап
        41477665 // Принимают решение
    ];
    private const FIELD_ID = 1527851;//booking_date
    private const API_KEY = "23bc075b710da43f0ffb50ff9e889aed";
    private $N = 5;
    private const PAGE_SIZE = 500;
    private $api;
    public function setN($n){
        $this->N = $n;
    }
    public function checkDates($numberDays){
        $currentDate = new DateTime();
        $numberReservationsByDate = [];
        $index = 0;
        $date = $currentDate;
        while($index<$numberDays){
            $numberReservationsByDate[$date->format("Y-m-d")] = 0;
            $date->modify("+1 day");
            $index++;
        }
        Configuration::getDefaultConfiguration()->setHost('https://api.s1.yadrocrm.ru/tmp')->setApiKey('key', self::API_KEY);
        $this->api = new ApiClient();
        try{
            $offset=0;
            do{
                $leads = $this->api->lead->getAll([], self::STATUS_IDS, [], null, self::PAGE_SIZE, $offset);
                if($leads["count"] === 0 || count($leads["result"])===0){
                    break;
                }
                foreach($leads["result"] as $lead){
                    if(!empty($lead["custom_fields"])){
                        foreach($lead["custom_fields"] as $field)
                        {
                            if($field["id"]===self::FIELD_ID){
                                file_put_contents("debug.log",print_r($field,true),FILE_APPEND);
                                $dateStr= (new DateTime($field["values"][0]["value"]))->format("Y-m-d");
                                if(array_key_exists($dateStr,$numberReservationsByDate)){
                                    $numberReservationsByDate[$dateStr]++;
                                }
                            }
                        }
                    }
                }
                $offset += self::PAGE_SIZE;
                sleep(1);
            }
            while($leads["count"] !== 0 && count($leads["result"])!==0);
            foreach($numberReservationsByDate as $date => $reservation)
            {
                if($numberReservationsByDate[$date]>=$this->N){
                    $numberReservationsByDate[$date] = false;
                }
                else{
                    $numberReservationsByDate[$date] = true;
                }           
            }
            return $numberReservationsByDate;
        }
        catch(Exception $e)
        {
            return null;
        }
    }
}
?>