<?php

namespace Cortadoverde\Mercadolibre\Entity;

/**
 * Class SellerReputation
 *
 * @package Cortadoverde\Mercadolibre\Entity
 */
class SellerReputation
{
    /**
     * @var string
     */
    public $level_id;

    /**
     * @var string
     */
    public $power_seller_status;

    /**
     * @var SellerTransaction
     */
    public $transactions;
}
