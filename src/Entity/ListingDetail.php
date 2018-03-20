<?php

namespace Cortadoverde\Mercadolibre\Entity;

/**
 * Class ListingDetail
 *
 * @package Cortadoverde\Mercadolibre\Entity
 */
class ListingDetail
{
    /**
     * @var integer
     */
    public $available_listings;

    /**
     * @var string
     */
    public $listing_type_id;

    /**
     * @var integer
     */
    public $remaining_listings;

    /**
     * @var integer
     */
    public $used_listings;
}
