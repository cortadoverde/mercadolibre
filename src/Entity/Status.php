<?php

namespace Cortadoverde\Mercadolibre\Entity;

/**
 * Class Status
 *
 * @package Cortadoverde\Mercadolibre\Entity
 */
class Status
{
    /**
     * @var StatusAction
     */
    public $billing;

    /**
     * @var StatusAction
     */
    public $buy;

    /**
     * @var boolean
     */
    public $confirmed_email;

    /**
     * @var boolean
     */
    public $immediate_payment;

    /**
     * @var StatusAction
     */
    public $list;

    /**
     * @var string
     */
    public $mercadoenvios;

    /**
     * @var string
     */
    public $mercadopago_account_type;

    /**
     * @var boolean
     */
    public $mercadopago_tc_accepted;

    /**
     * @var string
     */
    public $required_action;

    /**
     * @var StatusAction
     */
    public $sell;

    /**
     * @var string
     */
    public $site_status;

    /**
     * @var string
     */
    public $user_type;
}
