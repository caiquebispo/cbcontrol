<?php
namespace App\Class\App;

use App\Models\UserLoginHistory;
use DateInterval;
use DatePeriod;
use DateTime;

class SystemUsability{

    protected ?object $start = null;
    protected ?object $end = null;
    protected ?object $dateRange = null;

    public function __construct($start, $end)
    {
        $this->start = new DateTime($start);
        $this->end = new DateTime($end);
        $interval = new DateInterval('P1D');
        $this->dateRange = new DatePeriod($this->start, $interval, $this->end);
    }
    public function getDataTable(): array
    {
        $payload = $this->getLogs();
        return $this->dataTable($payload);
    }
    public function getDataGraphs(): array
    {
        $payload = $this->getLogs(false);
        return $this->dataGraphs($payload);
    }
    private function dataTable($payload): array
    {
        $data = [];
        foreach($payload as $pay){
            
            $data[] = [
                'user_id' => $pay->users()->first()->id,
                'user_name' => $pay->users()->first()->name,
                'company_authenticated' => $pay->users()->first()->company->corporate_reason,
                'login' => (new DateTime($pay->login))->format('d/m/Y H:i:s'),
                'logout' => $pay->logout != null ? (new DateTime($pay->login))->format('d/m/Y H:i:s') : 'NÃO RELAIZADO',
            ];
        }
        return $data;
    }
    private function dataGraphs($payload): array
    {
        $graph_navigation = [];
        $graph_location_city = [];
        $graph_location_state = [];

        foreach($payload as $pay){

            if(count($pay->history_navigation) > 0){
    
                foreach($pay->history_navigation as $navigation){
                    if(isset($navigation->module->name)){

                        $index_navigation = array_search($navigation->module->name, array_column($graph_navigation, 'name'));
                        if($index_navigation !== false){
                            $graph_navigation[$index_navigation]['total']++;
                        }else{
                            array_push($graph_navigation, ['name'=>$navigation->module->name, 'total' => 1]);
                        }
                    }
                }
            }
            $locationData = json_decode($pay->location, true);
            if(count($locationData) > 0){

                $index_location_city = array_search($locationData['cityName'], array_column($graph_location_city, 'name'));

                if($index_location_city !== false){
                    $graph_location_city[$index_location_city]['total']++;
                }else{
                    array_push($graph_location_city, ['name'=> $locationData['cityName'], 'total' => 1]);
                }

                $index_location_state = array_search($locationData['regionCode'], array_column($graph_location_state, 'name'));

                if($index_location_state !== false){
                    $graph_location_state[$index_location_state]['total']++;
                }else{
                    array_push($graph_location_state, ['name'=> $locationData['regionCode'], 'total' => 1]);
                }
            }
        }

        return [
            'graph_navigation' => $graph_navigation,
            'graph_location_city' => $graph_location_city,
            'graph_location_state' => $graph_location_state,
        ];
    }
    private function getLogs($is_grouped = true): object
    {
        if($is_grouped){

            return UserLoginHistory::with('history_navigation.module', 'users')
            ->whereBetween('day', [$this->start->format('Y-m-d'),$this->end->format('Y-m-d')])
            ->orderBy('login', 'DESC')
            ->get()
            ->unique('user_id');
        }
        return UserLoginHistory::with('history_navigation.module', 'users')
            ->whereBetween('day', [$this->start->format('Y-m-d'),$this->end->format('Y-m-d')])
            ->orderBy('login', 'DESC')
            ->get();
    }
}