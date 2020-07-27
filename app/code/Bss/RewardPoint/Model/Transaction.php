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
namespace Bss\RewardPoint\Model;

use Magento\Framework\Model\AbstractModel;

class Transaction extends AbstractModel
{
    /**
     * Model construct that should be used for object initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Bss\RewardPoint\Model\ResourceModel\Transaction::class);
    }

    /**
     * @param int $customerId
     * @param int $websiteId
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function loadByCustomer($customerId, $websiteId)
    {
        $data = $this->_getResource()->loadByCustomer($customerId, $websiteId);
        return $this->setData($data);
    }

    /**
     * @param array $bind
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getPointBalanceReview($bind)
    {
        return $this->_getResource()->getPointBalanceReview($bind);
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function updatePointUsed()
    {
        return $this->_getResource()->updatePointUsed($this);
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function updatePointExpired()
    {
        return $this->_getResource()->updatePointExpired();
    }
}
