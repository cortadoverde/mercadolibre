<?php

namespace Cortadoverde\Mercadolibre\Entity;

/**
 * Class User
 *
 * @package Cortadoverde\Mercadolibre\Entity
 */
class User
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var Address
     */
    public $address;

    /**
     * @var Phone
     */
    public $alternative_phone;

    /**
     * @var BillData
     */
    public $bill_data;

    /**
     * @var BuyerReputation
     */
    public $buyer_reputation;

    /**
     * @var string
     */
    public $country_id;

    /**
     * @var Company
     */
    public $company;

    /**
     * @var Context
     */
    public $context;

    /**
     * @var Credit
     */
    public $credit;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $first_name;

    /**
     * @var Identification
     */
    public $identification;

    /**
     * @var string
     */
    public $last_name;

    /**
     * @var string
     */
    public $logo;

    /**
     * @var string
     */
    public $nickname;

    /**
     * @var string
     */
    public $permalink;

    /**
     * @var Phone
     */
    public $phone;

    /**
     * @var integer
     */
    public $points;

    /**
     * @var \DateTime
     */
    public $registration_date;

    /**
     * @var string
     */
    public $secure_email;

    /**
     * @var string
     */
    public $seller_experience;

    /**
     * @var SellerReputation
     */
    public $seller_reputation;

    /**
     * @var array
     */
    public $shipping_modes;

    /**
     * @var string
     */
    public $site_id;

    /**
     * @var Status
     */
    public $status;

    /**
     * @var array
     */
    public $tags;

    /**
     * @var string
     */
    public $user_type;
}
