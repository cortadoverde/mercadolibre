<?php

namespace Cortadoverde\Mercadolibre\Resource;


class Search extends Client
{
  public function search_items( $site_id, $filters )
  {
    return $this->get( "/sites/{$site_id}/search", $this->setQuery( $filters ) );
  }
}
