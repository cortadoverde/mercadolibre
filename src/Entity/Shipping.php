<?php

namespace Cortadoverde\Mercadolibre\Entity;

/**
 * Class Shipping
 *
 * @package Cortadoverde\Mercadolibre\Entity
 */
class Shipping
{
    /**
     * @var string
     */
    public $dimensions;

    /**
     * @var boolean
     */
    public $free_shipping;

    /**
     * @var boolean
     */
    public $local_pick_up;

    /**
     * @var array
     */
    public $methods;

    /**
     * @var string
     */
    public $mode;

    /**
     * @var array
     */
    public $tags;
}
