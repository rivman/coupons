<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MinimumQuantityCoupon extends Model
{
    public function discount($cart){
        if($cart->totalQuantity() < $this->quantity || $cart->grossTotal() < $this->amount){
            return false;
        }

        if($this->percent_off && $this->value){
            return $this->percentOff($cart) + $this->valueOff();
        }

        if($this->percent_off){
            return $cart->grossTotal() * ($this->percent_off / 100);
        }

        if($this->value){
            return $this->value;
        }

    }

    protected function percentOff($cart){
        if($this->percent_off){
            return $cart->grossTotal() * ($this->percent_off / 100);
        }
    }

    protected function valueOff(){
        if($this->value){
            return $this->value;
        }
    }
}
