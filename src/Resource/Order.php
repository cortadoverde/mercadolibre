<?php

namespace Cortadoverde\Mercadolibre\Resource;


class Order extends Client
{

  public function get_orders( $filters = [] )
  {
    if( ! isset ( $filters['seller_id' ] ) ) {
      if( $this->getClient()->isAuth() ) {
        $user = new User( $this->getClient() );
        $filters['seller'] = $user->get_me()->id;
      }
    }

    return $this->get( "/orders/search", $this->setQuery( $filters ) );
  }

  public function get_orders_by_status( $status = 'confirmed')
  {
    $user = new User( $this->getClient() );
    $filters['seller'] = $user->get_me()->id;

    $filters['order.status'] = $status ;

    return $this->get( "/orders/search", $this->setQuery( $filters ) );
  }

  public function get_order_confirmed_payment()
  {
    $this->get_orders_by_status('confirmed');
  }

  public function get_order_pending_payment()
  {
    return $this->get_orders_by_status( 'payment_in_process' );
  }

}
