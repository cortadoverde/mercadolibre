# Cliente de conexion a la API de Mercadolibre

Primero que nada registrar una app en Mercadolibre

http://applications.mercadolibre.com/


1 - crear un array de configuracion con los siguientes datos

```
  [
    'APP_ID'     => 'xxxxxxxxxx',
    'SECRET'     => 'xxxxxxxxxx',
    'redirect'   => 'http://localhost/ml/test/auth.php'
  ]

```

en el archivo cfg.php hay ejemplos de distintas configuraciones que se pueden
intercambiar utilizando un indice u otro


2 - Instanciar el cliente de Mercadolibre desarrollado

```php
<?php
session_start();

include_once __DIR__ . '/vendor/autoload.php'

$mlData = include_once __DIR__ . '/cfg.php';

$auth = false;

$env = 'api_ml';

$cfg = ( isset ( $mlData[$env] ) ? $mlData[$env] : $mlData['testing'] );


$serializer = \JMS\Serializer\SerializerBuilder::create()
   ->addMetadataDir(__DIR__ . '/../resources/config/entity')
   ->build();

$client = new Cortadoverde\Mercadolibre\Client([], $serializer, $cfg);

```

Esta es la configuracion inicial, el cliente esta listo para acceder a los distintos recursos de la
API

3 - Utilizar los recursos que se encuentran en la carpeta src/Resource/{Resource_name}

Todos los recursos requiren como parametro constructor la instncia del Client

# Autenticacion
( ver ejemplo en /tests/auth.php );

- Chequear si se ecuentra autenticado

```
$client->isAuth()
```

- Obtener la url de Autenticacion de mercadolibre

```
$client->getAuthUrl( $cfg['redirect'] );
```
Se puede hacer una redireccion automatica, en vez de hacer un enlace con un
Hedader( 'Location: ' . $client->getAuthUrl( $cfg['redirect'] ) );

al aceptar la aplicacion mercadolibre nos va a redirigir a la url que este configurada
en la aplicacion, la misma debe coincidir con la que usemos en el config

**mercadolibre solo acepta el protocolo https, salvo para las url en localhost**

en la url de redireccion hay que autorizar el codigo obtenido para obtener el access_token

```
  $client->authorize( $_GET['code'] )

```

al llamar a este metodo se guardara en sesion el access_token, el refresh_token y el expires_in

con el metodo checkToken se podra ir actualizando el tiempo de vida del token

```
  $client->checkToken()
```

Con estos pasos ya tenemos nuestro access_token para poder consumir la API

## Lista de metodos para los recursos

### Listing

src/Resource/Listing

  * get_sites()
    -> Obtine los diferentes sitios de ML con su ID y nombre

  * get_site( $site_id )
    -> Obtine la informacion de un sitio especifico

  * get_site_domain( $domain_id )
    -> Obtiene informacion de un dominio en partiruclar ( ej: mercadolibre.com.ar )

  * get_site_payment_methods ( $site_id )
    -> Obtiene los diferentes metodos de pago para un site_id

  * get_site_payment_method_info ( $site_id, $payment_method_id )
    -> Obtiene informacion especifica de un tipo de pago

  * get_listing_types( $site_id )
    -> Obtiene los distintos tipos de publicacion para un sitio

  * get_listing_exposures( $site_id )
    -> Muestra los diferentes niveles de exposicion que tiene le sitio

  * get_listing_prices ( $site_id , $args )
    -> Obtiene los diferentes precios de publicacion segun el precio de publicacion
       tipo de lista y diferentes factores de ML, por eso para obtener el costo
       de la publicacion es necesario saber el precio del item

       Argumentos : [
         'price'           =>  1000 ,// > 0 Obligatorio,
         'listing_type_id' =>  null,
         'quantity'        =>  null,
         'category_id'     =>  null,
         'currency_id'     => "ARS"
       ];

### Categories

src/Resource/Category

    * get_categories( $site_id )
      -> Obtiene las categorias para un sitio

    * get_category ( $category_id )
      -> Obtiene la informacion especifica de un categoria/subcategoria

    * get_category_attributes ( $category_id )
      -> Obtiene las variaciones para una categoria

    * get_category_prediction( $site_id, $args )
      -> Obtiene las predicciones de las categorias

      Posibles argumentos
      [

        "title"         => "Core I",
        //"category_from" => null,
        //"price"         => null,
        //"seller_id"     => null

      ]

    * get_multiple_category_prediction ( $site_id, $category_data )
      -> obtener multiples predicciones pasando el formato de el metodo aterior un array agrupador

      [
        [ "title" => "a"], [ "title" => "b"]
      ]

## Item

src/Resource/Item

    * create( $attrs )
    -> Recurso para crear una publicacion

    * validate( $attrs )
    -> valida los datos para crear una publicacion
    devuelve true si es valido, sino un objeto con el mensaje de error

    * get_item( $item_id )
    -> Obtiene informacion del item

    * update_item( $item_id, $attrs )
    -> Actualiza un item

    * get_item_available_upgrades( $item_id )
    -> Obtiene las diferentes listing types que se pude hacer upgrade

    * relist_item( $item_id )
    -> Republica un item despues de haberse cerrado

    * update_sku_item( $item_id )
    -> Actuliza el campo seller_custom_field para poder hacer busquedas por sku

    * pause_item ( $item_id )
    -> Pone en pausa una publicacion

    * active_item( $item_id )
    -> Activa de nuevo el item
