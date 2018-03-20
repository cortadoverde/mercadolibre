<?php

namespace Cortadoverde\Mercadolibre\Resource;


class Listing extends Client
{
  public function get_sites()
  {
    return $this->get('/sites', []);
  }

  public function get_site( $site_id )
  {
    return $this->get("/sites/{$site_id}",[]);
  }

  public function get_site_domain( $domain )
  {
    return $this->get( "/site_domains/{$domain}", []);
  }

  public function get_site_payment_methods( $site_id )
  {
    return $this->get( "/sites/{$site_id}/payment_methods", [] );
  }

  public function get_site_payment_method_info( $site_id, $payment_method_id )
  {
    return $this->get( "/sites/{$site_id}/payment_methods/{$payment_method_id}" , [] );
  }

  public function get_listing_types( $site_id )
  {
    return $this->get( "/sites/{$site_id}/listing_types", []);
  }

  public function get_listing_exposures( $site_id )
  {
    return $this->get( "/sites/{$site_id}/listing_exposures");
  }

  public function get_listing_prices( $site_id, $args )
  {
    return $this->get( "/sites/{$site_id}/listing_prices", $this->setQuery( $args ) );
  }

  public function get_listing_type( $site_id, $listing_type_id )
  {
    return $this->get("/sites/{$site_id}/listing_types/{$listing_type_id}", []);
  }

}
