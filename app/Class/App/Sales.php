<?php

namespace App\Class\App;

use App\Models\User;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;

class Sales
{
    private ?User $user;

    private ?object $start;

    private ?object $end;

    private ?object $interval;

    private ?object $dateRange;

    /**
     * @throws \Exception
     */
    public function __construct($start = null, $end = null)
    {

        $this->start = is_object($start) ? $start : new DateTime($start);
        $this->end = is_object($end) ? $end : new DateTime($end);
        $this->interval = new DateInterval('P1D');
        $this->dateRange = new DatePeriod($this->start, $this->interval, $this->end->modify('+1 day'));
        $this->user = Auth::user();
    }

    public function getDataTableSales($orders = null): array|object
    {
        $sales = [];
        $payload = $orders ?? $this->getSalesBasedOnPeriods();
        foreach ($payload as $key_sale => $sale) {
            // dd($sale);
            $sales[$key_sale] = [
                'id' => $sale->id,
                'seller_name' => $sale->user?->name ?: 'SITE',
                'client_name' => $sale->client?->full_name ?: 'N/D',
                'received_name' => $sale->who_received?->name ?? 'N/D',
                'delivery_man' => $sale->delivery_man?->name ?? 'N/D',
                'phone_contact' => $sale->client?->number_phone ?: 'N/D',
                'type_payment_sale' => $this->getTypePayment($sale->payment_method),
                'segment' => $sale->origin === 'SITE' ? 'VENDA ONLINE' : 'VENDA BALCAO',
                'delivery_method' => $this->getTypeDelivery($sale->delivery_method),
                'value' => 'R$ ' . number_format($sale->total_amount, 2, ',', '.'),
                'hav' => $this->sumHav($sale->order_hav),
                'remain' => $this->remain($this->sumHav($sale->order_hav), ($sale->total_amount)),
                'total_items' => $sale->quantityItem,
                'status' => $this->getTypeStatus($sale->status_order),
                'payment_status' => $sale->payment_status == 'pending' ? 'PENDENTE' : 'PAGO',
                'canceled_reason' => $sale->status_order == 'canceled' && $sale->reason_id != null ? $sale->reason->name : 'NAO CANCELADA',
                'date' => (new DateTime($sale->day))->format('d/m/Y'),
                'duet_day' => $sale->duet_day != null ? (new DateTime($sale->duet_day))->format('d/m/Y') : (new DateTime($sale->day))->format('d/m/Y'),
                'received_day' => $sale->received_day != null ? (new DateTime($sale->received_day))->format('d/m/Y') : 'AGUARDANDO...',
                'qty_items' => count($sale->order_product),
                'products_sale' => [],
            ];
            foreach ($sale->order_product as $key_sale_product => $sale_product) {
                $sales[$key_sale]['products_sale'][$key_sale_product] = [
                    'name' => $sale_product->product->first()->name,
                    'category' => $sale_product->product->first()->categories->name,
                    'qty_product' => $sale_product->quantity,
                    'price' => 'R$ ' . number_format($sale_product->price, 2, ',', '.'),
                ];
            }
        }

        return $sales;
    }
    public function getSummarySales()
    {
        $data = $this->getDataTableSales();
        $summary = [];
        $summary['summary_products'] = $this->summaryProduct($data);
        $summary['summary_sellers'] = $this->summarySellers($data);
        $summary['summary_clients'] = $this->summaryClients($data);
        $summary['summary_received'] = $this->summaryReceived();
        $summary['general'] = $data;

        return $summary;
    }
    private function summarySellers($data)
    {

        $arr = [];

        foreach ($data as $key_d => $d) {

            foreach ($d['products_sale'] as $key_p => $product) {

                $index = -1;
                foreach ($arr as $key_a => $a) {

                    if (($a['name'] == $d['seller_name']) && ($a['product'] == $product['name'])) {
                        $index = $key_a;
                    }
                }

                if ($index > -1) {

                    $arr[$index]['quantity'] += $product['qty_product'];
                    $arr[$index]['price'] += (float) str_replace(',', '.', str_replace('.', '.', str_replace('R$ ', '', $product['price'])));
                } else {

                    array_push(
                        $arr,
                        [
                            'name' => $d['seller_name'],
                            'product' => $product['name'],
                            'quantity' => $product['qty_product'],
                            'price' => (float) str_replace(',', '.', str_replace('.', '.', str_replace('R$ ', '', $product['price']))),
                        ]
                    );
                }
            }
        }

        return $arr;
    }
    private function summaryReceived()
    {
        $payload =  $this->user->company->orders()
            ->with('user', 'client', 'who_received', 'order_product.product')->whereBetween(
                'received_day',
                [
                    now()->format('Y-m-d'),
                    now()->format('Y-m-d'),
                ]
            )
            ->get();
        $data = $this->getDataTableSales($payload);
        $arr = [];

        foreach ($data as $key_d => $d) {
            array_push(
                $arr,
                [
                    'name' => $d['client_name'],
                    'seller' => $d['seller_name'],
                    'date' => $d['date'],
                    'duet_day' => $d['duet_day'],
                    'received_name' => $d['received_name'],
                    'value' => $d['value'],
                ]
            );
        }
        return $arr;
    }
    private function summaryClients($data)
    {

        $arr = [];

        foreach ($data as $key_d => $d) {

            foreach ($d['products_sale'] as $key_p => $product) {

                $index = -1;
                foreach ($arr as $key_a => $a) {

                    if (($a['name'] == $d['client_name']) && ($a['product'] == $product['name'])) {
                        $index = $key_a;
                    }
                }

                if ($index > -1) {

                    $arr[$index]['quantity'] += $product['qty_product'];
                    $arr[$index]['price'] += (float) str_replace(',', '.', str_replace('.', '.', str_replace('R$ ', '', $product['price'])));
                } else {

                    array_push(
                        $arr,
                        [
                            'name' => $d['client_name'],
                            'product' => $product['name'],
                            'quantity' => $product['qty_product'],
                            'price' => (float) str_replace(',', '.', str_replace('.', '.', str_replace('R$ ', '', $product['price']))),
                        ]
                    );
                }
            }
        }

        return $arr;
    }
    private function summaryProduct($data): array
    {

        $arr = [];
        foreach ($data as $key_d => $d) {

            foreach ($d['products_sale'] as $key_p => $product) {

                $index_product = array_search($product['name'], array_column($arr, 'name'));

                if ($index_product !== false) {

                    $arr[$index_product]['price'] += (float) str_replace(',', '.', str_replace('.', '.', str_replace('R$ ', '', $product['price'])));
                    $arr[$index_product]['quantity'] += $product['qty_product'];
                } else {
                    array_push(
                        $arr,
                        [
                            'name' => $product['name'],
                            'quantity' => $product['qty_product'],
                            'price' => (float) str_replace(',', '.', str_replace('.', '.', str_replace('R$ ', '', $product['price']))),
                        ]
                    );
                }
            }
        }

        return $arr;
    }
    public function getDataGraph($type_graph = null, $field = null): ?array
    {
        return match ($type_graph) {
            'pizza' => $this->getDataGraphPizza($field),
            default => $this->getDataGraphComparisonLineOrBar()
        };
    }
    private function getDataGraphComparisonLineOrBar(): array
    {
        $data = $this->mountedArrayPeriods(['sale_actual' => 0, 'canceled_actual' => 0, 'sale_last' => 0, 'canceled_last' => 0]);

        $sales_actual_month = $this->getSalesBasedOnPeriods();
        $sales_last_month = $this->getSalesBasedOnPeriods(true);

        // Encase values in array actual the month
        foreach ($sales_actual_month as $sale) {
            $index_period = array_search($sale->day, array_column($data, 'day'));
            if ($index_period !== false) {
                if ($sale->status_order != 'canceled') {
                    $data[$index_period]['sale_actual'] += $sale->total_amount;
                } else {
                    $data[$index_period]['canceled_actual'] = $sale->total_amount;
                }
            }
        }
        // Encase values in array last the month
        foreach ($sales_last_month as $sale_last) {
            $index_period = array_search($sale_last->day, array_column($data, 'day_last'));
            if ($index_period !== false) {
                if ($sale_last->status_order != 'canceled') {
                    $data[$index_period]['sale_last'] += $sale_last->total_amount;
                } else {
                    $data[$index_period]['canceled_last'] = $sale_last->total_amount;
                }
            }
        }

        return $data;
    }
    private function getDataGraphPizza($field): array
    {
        return match ($field) {
            'status' => $this->getDataGraphForStatus(),
            'delivery' => $this->getDataGraphForDeliveryMethod(),
            'payment' => $this->getDataGraphForPaymentMethod(),
            'segment' => $this->getDataGraphForSegment(),
            'categories' => $this->getDataGraphForCategories(),
            'products' => $this->getDataGraphForProducts(),
            default => 'Error! Graph Type not mapping'
        };
    }
    private function getDataGraphForStatus(): array
    {
        return array_values(array_reduce($this->getSalesBasedOnPeriods()->toArray(), function ($accumulator, $item) {
            $index = $item['status_order'];

            if (!isset($accumulator[$index])) {
                $accumulator[$index] = [
                    'name' => $this->getTypeStatus($item['status_order']),
                    'total' => 0,
                ];
            }
            $accumulator[$index]['total']++;

            return $accumulator;
        }, []));
    }
    private function getDataGraphForDeliveryMethod(): array
    {
        return array_values(array_reduce($this->getSalesBasedOnPeriods()->toArray(), function ($accumulator, $item) {

            $index = $item['delivery_method'];

            if (!isset($accumulator[$index])) {
                $accumulator[$index] = [
                    'name' => $this->getTypeDelivery($item['delivery_method']),
                    'total' => 0,
                ];
            }
            $accumulator[$index]['total']++;

            return $accumulator;
        }, []));
    }
    private function getDataGraphForPaymentMethod(): array
    {
        return array_values(array_reduce($this->getSalesBasedOnPeriods()->toArray(), function ($accumulator, $item) {

            $index = $item['payment_method'];

            if (!isset($accumulator[$index])) {
                $accumulator[$index] = [
                    'name' => $this->getTypePayment($item['payment_method']),
                    'total' => 0,
                ];
            }
            $accumulator[$index]['total']++;

            return $accumulator;
        }, []));
    }
    private function getDataGraphForSegment(): array
    {
        return array_values(array_reduce($this->getSalesBasedOnPeriods()->toArray(), function ($accumulator, $item) {

            $index = $item['origin'];

            if (!isset($accumulator[$index])) {
                $accumulator[$index] = [
                    'name' => $item['origin'],
                    'total' => 0,
                ];
            }
            $accumulator[$index]['total']++;

            return $accumulator;
        }, []));
    }
    private function getDataGraphForCategories(): array
    {
        $data = [];
        foreach ($this->getSalesBasedOnPeriods() as $sale) {
            foreach ($sale->order_product as $sale_product) {

                $index = array_search($sale_product->product()->first()->categories->name, array_column($data, 'name'));

                if ($index !== false) {
                    $data[$index]['total']++;
                } else {
                    $data[] = ['name' => $sale_product->product()->first()->categories->name, 'total' => 1];
                }
            }
        }

        return $data;
    }
    private function getDataGraphForProducts(): array
    {

        $data = [];
        foreach ($this->getSalesBasedOnPeriods() as $sale) {
            foreach ($sale->order_product as $sale_product) {

                $index = array_search($sale_product->product()->first()->name, array_column($data, 'name'));

                if ($index !== false) {
                    $data[$index]['total']++;
                } else {
                    $data[] = ['name' => $sale_product->product()->first()->name, 'total' => 1];
                }
            }
        }

        return $data;
    }
    private function sumHav($order_hav): string
    {
        $hav = 0;
        if (count($order_hav) > 0) {
            foreach ($order_hav as $hav_pay) {

                $hav += $hav_pay->value;
            }
        }
        return 'R$ ' . number_format($hav, 2, ',', '.');
    }
    private function remain($hav, $total): string
    {
        $value = (float)str_replace(',', '.', str_replace('.', '', str_replace('R$ ', '', $hav)));
        return 'R$ ' . number_format(($total - $value), 2, ',', '.');
    }
    private function getTypeDelivery($method): string
    {
        return match ($method) {
            'delivery' => 'DELIVERY',
            default => 'RETIRAR NO LOCAL'
        };
    }
    private function getTypeStatus($method): string
    {
        return match ($method) {
            'new' => 'NOVA',
            'canceled' => 'CANCELADA',
            'confirmed' => 'CONFIRMADA',
            default => 'RETIRAR NO LOCAL'
        };
    }
    private function getTypePayment($method): string
    {
        return match ($method) {
            'credit_card' => 'CARTAO CREDITO/ E OU DEBITO',
            'in_count' => 'NA NOTA',
            default => 'A VISTA'
        };
    }
    private function mountedArrayPeriods($array_combine = null): array
    {
        $periods = [];
        foreach ($this->dateRange as $key_d => $d) {
            if ($array_combine) {
                $periods[$key_d] = array_merge(['day' => $d->format('Y-m-d'), 'day_last' => $d->modify('-1 months')->format('Y-m-d'), 'day_format' => $d->format('d/m')], $array_combine);
            } else {
                $periods[$key_d] = ['day' => $d->format('Y-m-d'), 'day_last' => $d->modify('-1 months')->format('Y-m-d'), 'day_format' => $d->format('d/m')];
            }
        }

        return $periods;
    }
    public function getSalesBasedOnPeriods($is_comparasion = false, $operator = '-', $quantity = 1, $type = 'months'): object
    {

        if ($is_comparasion) {
            return $this->user->company->orders()
                ->with('user', 'client', 'who_received', 'delivery_man', 'order_hav', 'order_product.product')->whereBetween(
                    'day',
                    [
                        $this->start->modify($operator . ' ' . $quantity . ' ' . $type)->format('Y-m-d'),
                        $this->end->modify($operator . ' ' . $quantity . ' ' . $type)->format('Y-m-d'),
                    ]
                )
                ->get();
        } else {
            return $this->user->company->orders()
                ->with('user', 'client', 'who_received', 'delivery_man', 'order_hav', 'order_product.product')->whereBetween('day', [$this->start->format('Y-m-d'), $this->end->format('Y-m-d')])
                ->get();
        }
    }
}
