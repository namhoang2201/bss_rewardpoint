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

use Bss\RewardPoint\Api\Data\AddPointCustomer;

/**
 * Interface TransactionInterface
 *
 * @package Bss\RewardPoint\Api
 */
interface TransactionInterface
{
    /**
     * Get Transaction by Customer id
     *
     * @param int $customerId
     * @return array
     */
    public function getByCustomerId($customerId);

    /**
     * Add point for Customer
     *
     * @param string[] $rewardPoint
     * @return AddPointCustomer
     */
    public function setData($rewardPoint);
}
