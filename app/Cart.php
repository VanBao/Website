<?php

use App\Product;

class Cart
{
  private $cart;
  public function __construct()
  {
    $this->cart = array();
  }

  public function getCart()
  {
    return $this->cart;
  }

  public function setCart($cart)
  {
    $this->cart = $cart;
  }

  public function getNumOfProduct()
  {
    return count($this->cart);
  }

  public function getTotalItem()
  {
    $sum = 0;
    foreach ($this->cart as $key => $value) {
      $sum += $value;
    }
    return $sum;
  }

  public function getNumItemAt($id)
  {
    return $this->cart[$id];
  }

  public function getTotalAt($id)
  {
    $product = Product::find($id);
    if($product->Promotion == 0){
      return $this->cart[$id] * $product->Price;
    }else{
      return $this->cart[$id] * $product->Promotion;
    }
  }

  public function getPriceOfItemAt($id)
  {
    $product = Product::find($id);
    return $product->Price;
  }

  public function cost()
  {
    $arrProduct = $this->getProductsInCart();
    $total = 0;
    foreach($arrProduct as $product){
      if($product->promotion == 0){
          $total += $this->cart[$product->id] * $product->price;
      }else{
          $total += $this->cart[$product->id] * $product->promotion;
      }
    }
    return $total;
  }

  public function update($id,$num)
  {
    if(array_key_exists($id, $this->cart))
    {
      $this->cart[$id] = $num;
    }
  }

  public function delete($id)
  {
    if(array_key_exists($id, $this->cart))
    {
       unset($this->cart[$id]);
    }
  }
  public function add($id, $num)
  {
    if(array_key_exists($id, $this->cart)){
      $this->cart[$id] += $num;
    }else{
      $this->cart[$id] = $num;
    }
  }
  public function getProductsInCart()
  {
    $arrayIDproduct = array_keys($this->cart);
    $result = array();
    foreach($arrayIDproduct as $IDproduct){
      array_push($result, Product::find($IDproduct));
    }
    return  $result;
  }
}
