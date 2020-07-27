<?php
/**
 * BSS Commerce Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://bsscommerce.com/Bss-Commerce-License.txt
 *
 * @category   BSS
 * @package    Bss_RewardPoint
 * @author     Extension Team
 * @copyright  Copyright (c) 2019-2020 BSS Commerce Co. ( http://bsscommerce.com )
 * @license    http://bsscommerce.com/Bss-Commerce-License.txt
 */
namespace Bss\RewardPoint\Block\Checkout;

/**
 * Class EarnPoint
 *
 * @package Bss\RewardPoint\Block\Checkout
 */
class EarnPoint extends \Magento\Checkout\Block\Total\DefaultTotal
{
    /**
     *
     * @var string
     */
    protected $_template = 'checkout/earn_point.phtml';
}
