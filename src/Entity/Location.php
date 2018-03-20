<?php

namespace Cortadoverde\Mercadolibre\Entity;

/**
 * Class Location
 *
 * @package Cortadoverde\Mercadolibre\Entity
 */
class Location
{
    /**
     * @var string
     */
    public $address_line;

    /**
     * @var Localization
     */
    public $city;

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
     * @var Localization
     */
    public $neighborhood;

    /**
     * @var string
     */
    public $open_hours;

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
