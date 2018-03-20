<?php

namespace Cortadoverde\Mercadolibre\Entity;

/**
 * Class SellerTransaction
 *
 * @package Cortadoverde\Mercadolibre\Entity
 */
class SellerTransaction
{
    /**
     * @var integer
     */
    public $canceled;

    /**
     * @var integer
     */
    public $completed;

    /**
     * @var string
     */
    public $period;

    /**
     * @var Rating
     */
    public $ratings;

    /**
     * @var integer
     */
    public $total;
}
