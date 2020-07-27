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

/**
 * Interface QuoteTotalsInterface
 *
 * @package Bss\RewardPoint\Api
 */
interface QuoteTotalsInterface
{
    /**
     * Update Totals of quote
     *
     * @param int $quoteId
     * @return \Bss\RewardPoint\Api\Data\UpdateItemDetailsInterface
     */
    public function update($quoteId);

    /**
     * Apply Earn points to quote
     *
     * @param int $quoteId
     * @return \Bss\RewardPoint\Api\Data\EarnPointInterface
     */
    public function applyEarnPoints($quoteId);
}
