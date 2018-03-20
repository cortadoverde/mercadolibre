<?php

namespace Cortadoverde\Mercadolibre;

@session_start();

use GuzzleHttp\Client as GuzzleClient;
use JMS\Serializer\SerializerInterface;
use Cortadoverde\Mercadolibre\Entity;


class Client
{

  const BASE_URI = "https://api.mercadolibre.com";

  const AUTH_URI = "https://auth.mercadolibre.com.ar";

  const OAUTH_URI = "/oauth/token";

  /**
   * Cliente http
   * @var GuzzleClient
   */
  private $http;

  /**
   * Serializador
   * @var SerializerInterface
   */
  private $serializer;

  /**
   * Access token de mercadolibre
   * @var sting
   */
  private $access_token;

  private $client_id;

  private $client_secret;

  private $refresh_token;

  private $redirect_uri;

  private static $instance = null;


  public function __construct( array $config = [], SerializerInterface $serializer, $appSettings = [] )
  {
    $defaults = [
      'base_uri' => self::BASE_URI,
      'base_url' => self::BASE_URI
    ];

    $config = array_merge( $defaults, $config );

    $this->http = new GuzzleClient( $config );

    $this->serializer = $serializer;

    $this->checkAuth( $appSettings );
  }

  public static function getInstance( array $config = [], SerializerInterface $serializer, $appSettings = [] )
  {
    if( self::$instance === null ) {
      self::$instance = new self( $config , $serializer, $appSettings );
    }
    return self::$instance;
  }

  private function checkAuth( $appSettings )
  {
    $client_id          = $appSettings['APP_ID'];
    $client_secret      = $appSettings['SECRET'];
    $access_token       = isset( $_SESSION['access_token'] ) ? $_SESSION['access_token'] : null ;
    $refresh_token      = isset( $_SESSION['refresh_token'] ) ? $_SESSION['refresh_token'] : null;
    $this->expires_in    = isset( $_SESSION['expires_in'] ) ? $_SESSION['expires_in'] : null;
    $this->redirect_uri = $appSettings['redirect'];

    $this->setApp( $client_id, $client_secret, $access_token, $refresh_token );

    $this->checkToken();

  }

  public function isAuth()
  {
    return ( $this->access_token !== null );
  }

  public function checkToken()
  {
    if( isset( $_SESSION['access_token'] ) )   $this->access_token = $_SESSION['access_token'];
    if( isset( $_SESSION['refresh_token'] ) )  $this->refresh_token = $_SESSION['refresh_token'];
    if( isset( $_SESSION['expires_in'] ) )      $this->expires_in = $_SESSION['expires_in'];

    if( $this->access_token === null ) return false;

    if( $this->expires_in < time() ) {
      try {
         return $this->refreshAccessToken();
      } catch (\Exception $e) {

      }

    }

    return false;
  }

  public function getClient()
  {
    return $this->http;
  }

  public function setApp( $client_id = null, $client_secret = null, $access_token = null, $refresh_token = null )
  {
    if( $client_id !== null ) $this->setClientId($client_id);
    if( $client_secret !== null ) $this->setClientSecret($client_secret);
    if( $access_token !== null ) $this->setAccessToken( $access_token );
    if( $refresh_token !== null ) $this->setRefreshToken( $refresh_token );
  }

  public function setClientId( $client_id )
  {
     $this->client_id = $client_id;
     return $this;
  }

  public function setClientSecret( $client_secret )
  {
    $this->client_secret = $client_secret;
    return $this;
  }

  public function setAccessToken( $access_token )
  {
    $this->access_token = $access_token;
    return $this;
  }

  public function setRefreshToken( $refresh_token )
  {
     $this->refresh_token = $refresh_token;
     return $this;
  }


  public function getAccessToken()
  {
    return $this->access_token;
  }

  public function getRefreshToken()
  {
    return $this->refresh_token;
  }

  public function getAuthUrl( $redirect_uri )
  {
    $this->redirect_uri = $redirect_uri;
    $params = [
      'client_id'     => $this->client_id,
      'response_type' => 'code',
      'redirect_uri'  => $redirect_uri
    ];

    return self::AUTH_URI . '/authorization?' . http_build_query( $params );
  }

  public function authorize( $code, $redirect_uri = false )
  {


    if( $redirect_uri != false ) {
      $this->redirect_uri = $redirect_uri;
    }

    $params = [
      'grant_type'   => "authorization_code",
      'client_id'    => $this->client_id,
      'client_secret' => $this->client_secret,
      'code'         => $code,
      'redirect_uri' => $this->redirect_uri
    ];

    $response = $this->http->post( self::OAUTH_URI , $this->setQuery($params) );

    $data = $this->getBody( $response );

    $_SESSION['access_token'] = $data->access_token;
    $_SESSION['refresh_token'] = $data->refresh_token;
    $_SESSION['expires_in']     = time() + $data->expires_in ;

    $this->checkToken();

    return $data;

  }


  public function refreshAccessToken()
  {
    if( $this->refresh_token === null ) return false;

    $params = [
      'grant_type'    => "authorization_code",
      'client_id'     => $this->client_id,
      'client_secret' => $this->client_secret,
      'refresh_token' => $this->refresh_token
    ];

    $response = $this->getClient()->post( self::OAUTH_URI, $this->setBody( $params ) );

    $data = $this->getBody( $response );

    $_SESSION['access_token'] = $data->access_token;
    $_SESSION['refresh_token'] = $data->refresh_token;
    $_SESSION['expires_in']     = time() + $data->expires_in ;

    $this->checkToken();

    return $data;
  }


  public function userShow( $user_id )
  {
    $response = $this->getClient()->get( "/users/{$user_id}" , $this->setQuery() );

    return $this->serializer->deserialize(
      $response->getBody()->getContents(),
      Entity\User::class,
      'json'
    );
  }

  public function userShowMe()
  {
    return $this->userShow("me");
  }

  public function getListingPrice( $query = [] )
  {
    if( ! isset( $query['price'] ) ) return false;

    $response = $this->getClient()->get(
      '/sites/MLA/listing_prices', $this->setQuery( $query )
    );

    return $this->serializer->deserialize(
      $response->getBody()->getContents(),
      "array<" . Entity\ListingPrice::class .">",
      'json'
    );

  }

  public function categoryList( $site_id )
  {
    $response = $this->getClient()->get(
      "/sites/{$site_id}/categories", $this->setQuery()
    );

    return $this->serializer->deserialize(
      $response->getBody()->getContents(),
      "array<" . Entity\Category::class .">",
      'json'
    );
  }

  public function categoryPredict( $site_id, $title )
  {
    $response = $this->getClient()->get(
      "/sites/{$site_id}/category_prediction/predict",
      $this->setQuery(['title' => $title])
    );

    return $this->serializer->deserialize(
      $response->getBody()->getContents(),
      Entity\CategoryPrediction::class,
      'json'
    );
  }

  public function validatePublish( Entity\Item $item )
  {
    $response = $this->getClient()->post(
      '/items/validate',
      array_merge( $this->setQuery(), $this->setBody( $item ) )
    );

    return $response->getBody()->getContents();
  }



  public function setQuery( array $query = [] )
  {
    $defaults = [];

    if( ! empty( $this->getAccessToken() ) ) {
      $defaults['access_token'] = $this->getAccessToken();
    }

    return [ "query" => array_merge( $defaults, $query ) ];
  }

  public function setBody( $object )
  {
    $json = $this->serializer->serialize( $object , 'json');
    return ['body' => $json ];
  }

  private function getBody( $response )
  {
    $json_string = $response->getBody()->getContents();
    return json_decode($json_string);
  }

  public function get( $uri, $query )
  {
    return $this->getBody(
      $this->getClient()->get( $uri, $query )
    );
  }

  public function post( $uri, $query, $getBody )
  {
    $response = $this->getClient()->post( $uri, $query );

    return ( $getBody ) ? $this->getBody( $response ) : $response ;
  }

  public function put( $uri, $query )
  {
    return $this->getBody(
      $this->getClient()->put( $uri, $query )
    );
  }

  public function delete( $uri, $query )
  {
    return $this->getBody(
      $this->getClient()->delete( $uri, $query )
    );
  }

}
