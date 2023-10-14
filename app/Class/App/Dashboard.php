<?php

namespace App\Class\App;

use App\Models\AccessSalesPage;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public  function  getDataGraphAccess($start, $end): ?array
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($start, $interval, $end->modify('+1 day'));

        return  $this->mountedStructureGraphAccess($daterange, $start, $end);
    }
    public  function  getDataGraphSalesForCategories($start, $end): ?array
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($start, $interval, $end->modify('+1 day'));

        return  $this->mountedStructureGraphSalesForCategories($daterange, $start, $end);
    }
    public  function  getDataTableSalesForCategories($start, $end): ?array
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($start, $interval, $end->modify('+1 day'));

        return  $this->mountedStructureTableSalesForCategories($daterange, $start, $end);
    }
    public  function  getDataTableSales($start, $end): ?array
    {
        $start = new DateTime($start);
        $end = new DateTime($end);
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($start, $interval, $end->modify('+1 day'));

        return  $this->mountedStructureTableSales($daterange, $start, $end);
    }
    public  function  getDataIndicators($start, $end): ?array
    {
        $start = new DateTime($start);
        $end = new DateTime($end);

        return  $this->mountedStructureIndicatorsDashboard($start, $end);
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
                    if($order_actual->status_order != 'canceled'){
                        $data[$key]['sales'] += $order_actual->total_amount;
                    }else{
                        $data[$key]['cancel_sales'] += $order_actual->total_amount;
                    }
                }
            }
            foreach($last_month as $key_order_last => $order_last){
                if($d['last_day'] == $order_last->day){
                    if($order_last->status_order != 'canceled'){
                        $data[$key]['last_sales'] += $order_last->total_amount;
                    }else{
                        $data[$key]['last_canceled_sales'] += $order_last->total_amount;
                    }
                }
            }
        }

        return $data;
    }
    private  function  mountedStructureGraphAccess($daterange,$start, $end): ?array
    {
        $data = [];
        foreach($daterange as $key_r => $r){
            $data[] = ["day" => $r->format('Y-m-d'), "access" => '0','last_day' => $r->modify('-1 month')->format('Y-m-d'), "last_access" => 0];
        }

        $actual_month =  Auth::user()->company->controlAccessSalePage()->whereBetween('day', [$start->format('Y-m-d'), $end->format('Y-m-d')])->get();
        $last_month = Auth::user()->company->controlAccessSalePage()->whereBetween('day', [$start->modify('-1 month')->format('Y-m-d'), $end->modify('-1 month')->format('Y-m-d')])->get();

        foreach($data as $key => $d){
            foreach($actual_month as $key_order_actual => $order_actual){
                if($d['day'] == $order_actual->day){
                    $data[$key]['access']++;
                }
            }
            foreach($last_month as $key_order_last => $order_last){
                if($d['last_day'] == $order_last->day){
                    $data[$key]['last_access']++;
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
                'type_payment' => $order->payment_method == 'credit_card' ?'CARTÃO DE DEBITO/CREDITO' : 'Á VISTA',
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
    private  function mountedStructureGraphSalesForCategories($daterange, $start, $end): ?array
    {
        $data = [];
        $categories = Auth::user()->company->categories;
        $orders = Auth::user()->company->orders()->with('order_product.product.categories')->whereBetween('day', [$start->format('Y-m-d'), $end->format('Y-m-d')])->get();

        foreach ($categories as $key_category => $category){
            $data[] = ['id' => $category->id, 'name' => $category->name, 'total' => 0];
        }
        foreach($orders as $key_order => $order){
            foreach ($order->order_product as $key_order_product => $order_product){
                foreach ($data as $key_d => $d){
                    if($data[$key_d]['id'] == $order_product->product->first()->category_id){
                        $data[$key_d]['total']++;
                    }
                }
            }

        }
        return  $data;
    }
    private  function mountedStructureTableSalesForCategories($daterange, $start, $end): ?array
    {
        $data = [];
        $categories = Auth::user()->company->categories;
        $orders = Auth::user()->company->orders()->with('order_product.product.categories')->whereBetween('day', [$start->format('Y-m-d'), $end->format('Y-m-d')])->get();

        foreach ($categories as $key_category => $category){
            $data[] = ['id' => $category->id, 'name' => $category->name, 'total' => 0, 'total_amount' => 0, 'category_details' => []];
        }
        foreach($orders as $key_order => $order){
            foreach ($order->order_product as $key_order_product => $order_product){
                foreach ($data as $key_d => $d){
                    if($data[$key_d]['id'] == $order_product->product->first()->category_id){
                        $data[$key_d]['total']++;
                        $data[$key_d]['total_amount'] += ($order_product->quantity*$order_product->price);
                        $data[$key_d]['category_details'][] = [
                            'name' => $order_product->product->first()->name,
                            'category' => $order_product->product->first()->categories->name,
                            'qty_product' => $order_product->quantity,
                            'price' =>  $order_product->price
                        ];
                    }
                }
            }

        }
        return  $data;
    }
    private  function mountedStructureIndicatorsDashboard($start, $end)
    {

        $actual_month = Auth::user()->company->orders()->whereBetween('day', [$start->format('Y-m-d'), $end->format('Y-m-d')])
            ->select(DB::raw('sum(total_amount) as revenue, count(*) as total_sales'))
            ->where('status_order', '!=', 'canceled')
            ->first();

        $actual_month_canceled = Auth::user()->company->orders()->whereBetween('day', [$start->format('Y-m-d'), $end->format('Y-m-d')])
            ->select(DB::raw('sum(total_amount) as revenue_canceled, count(*) as total_sales_canceled'))
            ->where('status_order', 'canceled')
            ->first();

        $actual_access = Auth::user()->company->controlAccessSalePage()->whereBetween('day', [$start->format('Y-m-d'), $end->format('Y-m-d')])->count();
        $last_access = Auth::user()->company->controlAccessSalePage()->whereBetween('day', [$start->modify('-1 month')->format('Y-m-d'), $end->modify('-1 month')->format('Y-m-d')])->count();

        $last_month = Auth::user()->company->orders()->whereBetween('day', [$start->modify('-1 month')->format('Y-m-d'), $end->modify('-1 month')->format('Y-m-d')])
            ->select(DB::raw('sum(total_amount) as last_revenue, count(*) as last_total_sales'))
            ->where('status_order', '!=', 'canceled')
            ->first();

        $last_month_canceled = Auth::user()->company->orders()->whereBetween('day', [$start->modify('-1 month')->format('Y-m-d'), $end->modify('-1 month')->format('Y-m-d')])
            ->select(DB::raw('sum(total_amount) as last_revenue_canceled, count(*) as last_total_sales_canceled'))
            ->where('status_order', 'canceled')
            ->first();

        $data = [];
        $percentage_actual_month_revenue = $actual_month->revenue != 0 ? (($actual_month->revenue-$last_month->last_revenue)/$actual_month->revenue)*100 : 0;
        $percentage_actual_month_sales = $actual_month->total_sales != 0 ? (($actual_month->total_sales-$last_month->last_total_sales)/$actual_month->total_sales)*100 : 0;
        $percentage_actual_month_sales_canceled = $actual_month_canceled->total_sales_canceled != 0 ? (($actual_month_canceled->total_sales_canceled-$last_month_canceled->last_total_sales_canceled)/$actual_month_canceled->total_sales_canceled)*100 : 0;
        $percentage_actual_access = $actual_access != 0 ? (($actual_access-$last_access)/$actual_access)*100 : 0;

        $data['indicator_revenue'] = ['revenue' => $actual_month->revenue,'last_revenue' => $last_month->last_revenue, 'percentage' => $percentage_actual_month_revenue];
        $data['indicator_sales'] = ['sales' => $actual_month->total_sales, 'last_sales' => $last_month->last_total_sales,'percentage' => $percentage_actual_month_sales];
        $data['indicator_sales_canceled'] = ['sales_canceled' => $actual_month_canceled->total_sales_canceled, 'last_sales_canceled' => $last_month_canceled->last_total_sales_canceled,'percentage' => $percentage_actual_month_sales_canceled];
        $data['indicator_access'] = ['access' => $actual_access, 'last_access' => $last_access, 'percentage' => $percentage_actual_access];
        return $data;

    }
}
