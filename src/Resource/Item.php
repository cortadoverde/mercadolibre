<?php

namespace Cortadoverde\Mercadolibre\Resource;


class Item extends Client
{
  public function create( $attrs )
  {

    $query = array_merge(
      $this->setBody($attrs),
      $this->setQuery()
    );

    return $this->post('/items', $query );
  }

  public function validate( $attrs )
  {
    try {
      $response = $this->post('/items/validate',array_merge( $this->setBody($attrs), $this->setQuery() ), false );
      return true;

    } catch (\Exception $e) {
      return json_decode($e->getResponse()->getBody()->getContents());
    }

  }

  public function get_item( $item_id )
  {
    return $this->get("/items/{$item_id}", $this->setQuery());
  }

  public function get_items( $attrs = [] )
  {
    return $this->get("/items", $this->setQuery( $attrs ));
  }

  public function update_item( $item_id, $attrs )
  {
    return $this->put("/items/{$item_id}", array_merge( $this->setQuery(),$this->setBody($attrs)));
  }

  public function get_item_available_upgrades( $item_id )
  {
    return $this->get("/items/{$item_id}/available_upgrades", $this->setQuery());
  }

  public function relist_item( $item_id, $attrs )
  {
    return $this->post("/items/{$item_id}/relist", array_merge( $this->setQuery(),$this->setBody($attrs)));
  }

  public function get_item_description( $item_id )
  {
    return $this->get("/items/{$item_id}/description", []);
  }

  public function update_item_description( $item_id, $description )
  {
    return $this->put( "/items/{$item_id}/description",array_merge( $this->setQuery(),$this->setBody( ['text' => $description ] ) ) );
  }

  public function update_item_attributes( $item_id, $attrs )
  {
    return $this->put("/items/{$item_id}", array_merge( $this->setQuery(),$this->setBody($attrs) ) );
  }

  public function get_item_identifiers( $item_id )
  {
    return $this->get("/items/{$item_id}/product_identifiers", $this->setQuery());
  }

  public function update_item_identifiers( $item_id, $attrs )
  {
    return $this->put("/items/{$item_id}/product_identifiers", array_merge( $this->setQuery(),$this->setBody($attrs) ) );
  }

  public function update_sku_item( $item_id, $sku )
  {
    $query = array_merge( $this->setBody( [ "seller_custom_field" => $sku ] ), $this->setQuery() );
    return $this->put("/items/{$item_id}", $query);
  }

}
