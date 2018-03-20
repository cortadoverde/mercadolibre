<?php

namespace Cortadoverde\Mercadolibre\Entity;

/**
 * Class CategoryPrediction
 *
 * @package Cortadoverde\Mercadolibre\Entity
 */
class CategoryPrediction
{
    /**
     * @var array
     */
    public $path_from_root;

    /**
     * @var float
     */
    public $prediction_probability;

    /**
     * @var array
     */
    public $shipping_modes;
}
