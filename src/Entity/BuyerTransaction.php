<?php

namespace Cortadoverde\Mercadolibre\Entity;

/**
 * Class BuyerTransaction
 *
 * @package Cortadoverde\Mercadolibre\Entity
 */
class BuyerTransaction
{
    /**
     * @var Canceled
     */
    public $canceled;

    /**
     * @var integer
     */
    public $completed;

    /**
     * @var NotYetRated
     */
    public $not_yet_rated;

    /**
     * @var string
     */
    public $period;

    /**
     * @var integer
     */
    public $total;

    /**
     * @var Unrated
     */
    public $unrated;
}
