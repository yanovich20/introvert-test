<?php
namespace Src;
require_once(__DIR__ . '/../vendor/autoload.php');

/*try {
    $leadSumm = new MyLeadSumm();
    $result = $leadSumm->CalcSummForAllClients(null,null);
    echo "<pre>". print_r($result,true)."</pre>";
} catch (Exception $e) {
    echo 'Exception when calling: ', $e->getMessage(), PHP_EOL;
}*/
class MyLeadSumm{
    private $api;
    const PAGE_SIZE = 500;
    const STATUS_ID = 142;
    public function CalcSummForAllClients($date_from,$date_to){
        if(!$date_from)
            $date_from = $_GET["date_from"];
        if(!$date_to)
            $date_to = $_GET["date_to"];

        $clients = $this->getClients();
        $totalSumm = 0;
        $html = "<table><thead><th>id</th><th>name</th><th>summ</th><tbody>";
        foreach($clients as $client)
        {
            \Introvert\Configuration::getDefaultConfiguration()->setHost('https://api.s1.yadrocrm.ru/tmp')->setApiKey('key', $client["api"]);
            $this->api = new \Introvert\ApiClient();
            $summByClient=$this->getSummByClient($date_from,$date_to);
            if($summByClient===-1)
            {
                $html .= "<tr><td>{$client['id']}</td><td>{$client['name']}</td><td>0</td></tr>";
                unset($this->api);
                continue;
            }
            $infoClient = $this->api->account->info();
            $totalSumm+=$summByClient;
            if(empty($infoClient["result"]))
            {
                $html .= "<tr><td>{$client['id']}</td><td>{$client['name']}</td><td>0</td></tr>";
                unset($this->api);
                continue;
            }
            $html.="<tr><td>{$infoClient['result']['id']}</td><td>{$infoClient['result']['name']}</td><td>{$summByClient}</td></tr>";
            unset($this->api);
        }
        $html.="<td colspan='2'>Total</td><td>{$totalSumm}</td></tbody></table>";
        return $html;
    }
    private function getClients(){
        return [
            [
                'id'=>"1",
                "name"=>"introvert",
                "api"=>"23bc075b710da43f0ffb50ff9e889aed"
            ],
            [
                'id'=>"2",
                "name"=>"introvert_wrong",
                "api"=>"23bc075b710da43f0ffb5086f9e88a999"
            ]
        ];
    }
    private function getSummByClient($date_from,$date_to){
        $summ=0;
        $offset=0;
        try{
            do{
                $leads = $this->api->lead->getAll([], [self::STATUS_ID], [], null, self::PAGE_SIZE, $offset);
                if($leads["count"] === 0 || count($leads["result"])===0){
                    break;
                }
                foreach($leads["result"] as $lead){
                    if($lead["date_close"]>=$date_from&&$lead["date_close"]<=$date_to)
                    {
                       $summ += $lead["price"];
                    }
                }
                $offset += self::PAGE_SIZE;
                sleep(1);
            }
            while($leads["count"] !== 0 && count($leads["result"])!==0);
            return $summ;
        }
        catch (\Exception $e) {
            //echo 'Exception when calling getSummByClient: ', $e->getMessage(), PHP_EOL;
            return -1;
        }
    }
}
?>