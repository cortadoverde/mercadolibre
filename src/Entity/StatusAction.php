<?php

namespace Cortadoverde\Mercadolibre\Entity;

/**
 * Class StatusAction
 *
 * @package Cortadoverde\Mercadolibre\Entity
 */
class StatusAction
{
    /**
     * @var boolean
     */
    public $allow;

    /**
     * @var array
     */
    public $codes;

    /**
     * @var ImmediatePayment
     */
    public $immediate_payment;
}
