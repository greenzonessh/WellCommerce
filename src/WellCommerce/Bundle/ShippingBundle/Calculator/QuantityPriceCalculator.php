<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 * 
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 * 
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\ShippingBundle\Calculator;

use WellCommerce\Bundle\FormBundle\FormBuilderInterface;
use WellCommerce\Bundle\FormBundle\Dependencies\DependencyInterface;
use WellCommerce\Bundle\FormBundle\Elements\FormInterface;

/**
 * Class QuantityPriceCalculator
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class QuantityPriceCalculator extends AbstractShippingMethodCalculator implements ShippingMethodCalculatorInterface
{
    protected $alias = 'quantity_price';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Quantity dependent price';
    }
}
