<?php

namespace Cortadoverde\Mercadolibre\Entity;

/**
 * Class SellerAddress
 *
 * @package Cortadoverde\Mercadolibre\Entity
 */
class SellerAddress
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $address_line;

    /**
     * @var Localization
     */
    public $city;

    /**
     * @var string
     */
    public $comment;

    /**
     * @var Localization
     */
    public $country;

    /**
     * @var float
     */
    public $latitude;

    /**
     * @var float
     */
    public $longitude;

    /**
     * @var SearchLocation
     */
    public $search_location;

    /**
     * @var Localization
     */
    public $state;

    /**
     * @var string
     */
    public $zip_code;
}
