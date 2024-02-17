<?php

namespace App\Class\App\BoxFront;

use App\Models\Client;

class ProcessingCartItemsCheckout
{
    private object $client;

    public function __construct(
        protected ?int $client_id,
        protected ?string $paymentMethod,
        protected ?int $type_increase_or_decrease = null,
        protected ?float $value_increase_or_decrease = null,
    ) {
        if ($this->client_id != null) {
            $this->client = Client::find($this->client_id);
        }
    }
    public static  function processing()
    {
    }
    public function verifyHasItemsCart(): bool
    {
        return count(\Cart::content()) > 0 ? true : false;
    }
    public function verifyClientCanBuy(): bool
    {

        if ((isset($this->client->group->name) && !$this->canBuy($this->client->group->name)) && $this->paymentMethod == "in_count") {
            return false;
        }
        return true;
    }
    public function makeCalcIcreaseOrDecrease(): float
    {
        $value = 0;
        switch ((int)$this->type_increase_or_decrease) {
            case 0:
                $value = ((float)\Cart::subtotal() - (float)$this->value_increase_or_decrease);
                break;
            case 1:
                $value = ((float)\Cart::subtotal() + (float)$this->value_increase_or_decrease);
                break;
            default:
                $value = (float)\Cart::subtotal();
                break;
        }
        return  $value;
    }
    private function canBuy($group)
    {
        return match (strtoupper($group)) {
            'NEGATIVADO' => false,
            'NEGATIVADOS' => false,
            'DUVIDOSO' => false,
            'DUVIDOSOS' => false,
            default => true,
        };
    }
}
