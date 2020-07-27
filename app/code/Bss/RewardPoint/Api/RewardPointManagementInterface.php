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
namespace Bss\RewardPoint\Api;

use Magento\Quote\Model\Quote;

interface RewardPointManagementInterface
{
    /**
     * Set reward points to quote
     *
     * @param int $point
     * @param Quote $quote
     * @return $this
     */
    public function apply($point, $quote = null);

    /**
     * Get module configs
     *
     * @param int $storeview
     * @return string[]
     */
    public function getAllModuleConfig($storeview = null);
}
