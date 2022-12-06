<?php


class Cart
{
    private array $items = [];
    //TODO Skriv getter för items
    
    public function getItems() {
    return $this->items;
    }

    /*
     Skall lägga till en produkt i kundvagnen genom att
     skapa ett nytt cartItem och lägga till i $items array.
     Metoden skall returnera detta cartItem.

     VG: Om produkten redan finns i kundvagnen
     skall istället quantity på cartitem ökas.
     */
    public function addProduct($product)
    {
    
       $cartItem = $this->items[$product->getId()] ?? null;

       if ($cartItem === null) {
        $cartItem = new CartItem($product, 0);

        $this->items[$product->getId()] = $cartItem;
       }

       $cartItem->increaseQuantity();
        return $cartItem;
    }

    //Skall ta bort en produkt ur kundvagnen (använd unset())
    public function removeProduct($product)
    {
        unset($this->items[$product->getId()]);
    }

    //Skall returnera totala antalet produkter i kundvagnen
    //OBS: Ej antalet unika produkter
    public function getTotalQuantity()
    {
        $calcQuantity = 0;
        foreach($this->items as $items) {
            $calcQuantity += $items->getQuantity();
        }

        $totQuantity = 0+ $calcQuantity;
        return $totQuantity;
    }

    //Skall räkna ihop totalsumman för alla produkter i kundvagnen
    //VG: Tänk på att ett cartitem kan ha olika quantity
    public function getTotalSum()
    {
        $calcPrice = 0;
        foreach($this->items as $items) {
            $calcPrice += $items->getProduct()->getPrice() * $items->getQuantity();
        }

        $totSum = 0+ $calcPrice;
        return $totSum;
    }

}
