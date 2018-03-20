<?php

namespace Cortadoverde\Mercadolibre\Entity;

/**
 * Class ListingPrice
 *
 * @package Cortadoverde\Mercadolibre\Entity
 */
class ListingPrice
{
    /**
     * @var integer
     */
    public $listing_type_id;

    /**
     * @var string
     */
    public $listing_exposure;

    /**
     * @var boolean
     */
    public $requires_picture;

    /**
     * @var string
     */
    public $currency_id;

    /**
     * @var float
     */
    public $listing_fee_amount;

    /**
     * @var float
     */
    public $sale_fee_amount;

    /**
     * @var boolean
     */
    public $free_relist;

    /**
     * @var \DateTime
     */
    public $stop_time;
}
