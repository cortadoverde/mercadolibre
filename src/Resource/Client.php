<?php

namespace Cortadoverde\Mercadolibre\Resource;

use Cortadoverde\Mercadolibre\Client AS BaseClient;

class Client
{
  public static $instance = null;

  private $client = null;

  public function __construct( \Cortadoverde\Mercadolibre\Client $client )
  {
    $this->client = $client;
  }

  public function getClient()
  {
    return $this->client;
  }

  public function get( $uri , $query )
  {
    return $this->client->get( $uri, $query );
  }

  public function post( $uri, $query, $getBody = true )
  {
    return $this->client->post( $uri, $query, $getBody );
  }

  public function put( $uri, $query )
  {
    return $this->client->put( $uri, $query );
  }

  public function delete( $uri, $query )
  {
    return $this->client->delete( $uri, $query );
  }

  public function setQuery( $query = [] )
  {
    return $this->client->setQuery( $query );
  }

  public function setBody( $query = [] )
  {
    return $this->client->setBody( $query );
  }
}
