<?php

namespace App\Cart;

use App\Product;

class Cart
{
    protected $shipping_cost = 5;
    protected $shipping_rate = 50;

    protected $sessionName = 'cart';

    protected $cart;

    public function __construct()
    {
        $this->cart = session()->has($this->sessionName) ? session()->get($this->sessionName) : [];
    }

    public function add(Product $product, $quantity)
    {
        if($this->has($product)){
            $quantity = $this->get($product)['quantity'] + $quantity;
        }

        $this->update($product, $quantity);
    }

    public function update(Product $product, $quantity)
    {
        if(!$product->hasStock($quantity)){
            // throw exception
        }

        if($quantity == 0){
            $this->remove($product);
            return;
        }

        $this->cart[$product->id] = [
            'product_id' => $product->id,
            'quantity' => (int) $quantity
        ];

        session()->put($this->sessionName, $this->cart);
    }

    public function remove(Product $product)
    {
        session()->forget($this->sessionName .'.'. $product->id);

        unset($this->cart[$product->id]);
    }

    public function has(Product $product)
    {
        return session()->has($this->sessionName .'.'. $product->id);
    }

    public function get(Product $product)
    {
        return session()->get($this->sessionName .'.'. $product->id);
    }

    public function clear()
    {
        session()->forget($this->sessionName);

        unset($this->cart);
    }

    public function all()
    {
        $ids = [];
        $items = [];

        foreach($this->cart as $item){
            $ids[] = $item['product_id'];
        }

        $products = Product::find($ids);

        foreach($products as $product){
            $product->quantity = $this->get($product)['quantity'];

            $items[] = $product;
        }

        return $items;
    }

    public function itemCount()
    {
        return count($this->cart);
    }

    public function subTotal()
    {
        $total = 0;

        foreach($this->all() as $item) {
            if($item->outOfStock()){
                continue;
            }

            $total = $total + $item->price * $item->quantity;
        }

        return $total;
    }

    public function refresh()
    {
        foreach($this->all() as $item){
            if(!$item->hasStock($item->quantity)){
                $this->update($item, $item->stock);
            }
        }
    }

    public function shipping()
    {
        if($this->subTotal() >= $this->shipping_rate){
            return 0;
        } else {
            return $this->shipping_cost;
        }
    }

    public function total()
    {
        return ($this->subTotal() + $this->shipping());
    }
}