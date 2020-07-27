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

use Bss\RewardPoint\Api\Data\AddPointCustomerFactory;
use Bss\RewardPoint\Model\ResourceModel\Transaction\CollectionFactory;

/**
 * Class TransactionRepository
 *
 * @package Bss\RewardPoint\Model
 */
class TransactionRepository implements \Bss\RewardPoint\Api\TransactionInterface
{
    /**
     * @var TransactionFactory
     */
    protected $transactionFactory;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var AddPointCustomerFactory
     */
    protected $addPointCustomerFactory;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    private $dateTime;

    /**
     * TransactionRepository constructor.
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     * @param CollectionFactory $collectionFactory
     * @param TransactionFactory $transactionFactory
     * @param AddPointCustomerFactory $addPointCustomerFactory
     */
    public function __construct(
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        CollectionFactory $collectionFactory,
        \Bss\RewardPoint\Model\TransactionFactory $transactionFactory,
        AddPointCustomerFactory $addPointCustomerFactory
    ) {
        $this->transactionFactory = $transactionFactory;
        $this->collectionFactory = $collectionFactory;
        $this->addPointCustomerFactory = $addPointCustomerFactory;
        $this->dateTime = $dateTime;
    }

    /**
     * Get transaction by customer id
     *
     * @param int $customerId
     * @return array
     */
    public function getByCustomerId($customerId)
    {
        $transaction = $this->collectionFactory->create()
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_id', $customerId);
        return $transaction->getData();
    }

    /**
     * Add point for Customer
     *
     * @param string[] $rewardPoint
     * @return \Bss\RewardPoint\Api\Data\AddPointCustomer
     */
    public function setData($rewardPoint)
    {
        $api = $this->addPointCustomerFactory->create();
        if ($this->dateTime->gmtDate('Y-m-d', $rewardPoint['expires_at'])
            || $rewardPoint['expires_at'] == null) {
            $expiresAt = $rewardPoint['expires_at'];
        } else {
            $api->setStatus(false);
            $api->setMessage(__('expires_at need Y-m-d format'));
            return $api;
        }
        $model = $this->transactionFactory->create();
        $model->setWebsiteId($rewardPoint['website_id']);
        $model->setCustomerId($rewardPoint['customer_id']);
        $model->setPoint($rewardPoint['point']);
        $model->setAction($rewardPoint['action']);
        $model->setActionId($rewardPoint['action_id']);
        $model->setNote($rewardPoint['note']);
        $model->setCreatedBy($rewardPoint['created_by']);
        $model->setIsExpired($rewardPoint['is_expired']);
        $model->setExpiresAt($expiresAt);
        try {
            $model->save();
            $api->setStatus(true);
            $api->setMessage(__('Successfully save'));
            return $api;
        } catch (\Exception $e) {
            $api->setStatus(false);
            $api->setMessage(__('Error'));
            return $api;
        }
    }
}
