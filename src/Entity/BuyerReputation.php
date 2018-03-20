<?php

namespace Cortadoverde\Mercadolibre\Entity;

/**
 * Class BuyerReputation
 *
 * @package Cortadoverde\Mercadolibre\Entity
 */
class BuyerReputation
{
    /**
     * @var integer
     */
    public $canceled_transactions;

    /**
     * @var array
     */
    public $tags;

    /**
     * @var BuyerTransaction
     */
    public $transactions;
}
