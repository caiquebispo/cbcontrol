<?php

namespace App\Class\App;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;

class Dashboard
{
    public  function  getDataGraphSales($start, $end): ?array
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($start, $interval, $end->modify('+1 day'));

        return  $this->mountedStructureGraphSales($daterange, $start, $end);

    }
    public  function  getDataTableSales($start, $end): ?array
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($start, $interval, $end->modify('+1 day'));

        return  $this->mountedStructureTableSales($daterange, $start, $end);

    }
    private  function  mountedStructureGraphSales($daterange,$start, $end): ?array
    {
        $data = [];
        foreach($daterange as $key_r => $r){
            $data[] = ["day" => $r->format('Y-m-d'), "sales" => '0', "cancel_sales" => 0,'last_day' => $r->modify('-1 month')->format('Y-m-d'), "last_sales" => 0,"last_canceled_sales" => 0];
        }

        $actual_month = Auth::user()->company->orders()->whereBetween('day', [$start->format('Y-m-d'), $end->format('Y-m-d')])->get();
        $last_month = Auth::user()->company->orders()->whereBetween('day', [$start->modify('-1 month')->format('Y-m-d'), $end->modify('-1 month')->format('Y-m-d')])->get();

        foreach($data as $key => $d){
            foreach($actual_month as $key_order_actual => $order_actual){
                if($d['day'] == $order_actual->day){
                    if($order_actual->status != 'canceled'){
                        $data[$key]['sales'] += $order_actual->total_amount;
                    }else{
                        $data[$key]['cancel_sales'] += $order_actual->total_amount;
                    }
                }
            }
            foreach($last_month as $key_order_last => $order_last){
                if($d['last_day'] == $order_last->day){
                    if($order_last->status !== 0){
                        $data[$key]['last_sales'] += $order_last->total_amount;
                    }else{
                        $data[$key]['last_canceled_sales'] += $order_last->total_amount;
                    }
                }
            }
        }

        return $data;
    }
    private  function mountedStructureTableSales($daterange, $start, $end): ?array
    {
        $data = [];
        $orders = Auth::user()->company->orders()->with('order_product.product.categories')->whereBetween('day', [$start->format('Y-m-d'), $end->format('Y-m-d')])->get();

        foreach ($orders as $key_order => $order){
            $data[$key_order] = [
                'type_payment' => $order->payment_method == 'credit_card' ?'CARÃO DEBITO/CREDITO' : 'Á VISTA',
                'delivery_method' => $order->delivery_method == 'delivery' ?'DELIVERY' : 'RETIRAR NO LOCAL' ,
                'status' => $order->status_order,
                'qty_product' => $order->quantityItem,
                'total_amount' => $order->total_amount,
                'details_order' => []
            ];

            foreach ($order->order_product as $key_order_product => $order_product){
                $data[$key_order]['details_order'][$key_order_product] = [
                    'name' => $order_product->product->first()->name,
                    'category' => $order_product->product->first()->categories->name,
                    'qty_product' => $order_product->quantity,
                    'price' =>  $order_product->price
                ];
            }

        }

        return $data;
    }
}
