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
 * @package    Bss_RewardPointGraphQl
 * @author     Extension Team
 * @copyright  Copyright (c) 2020 BSS Commerce Co. ( http://bsscommerce.com )
 * @license    http://bsscommerce.com/Bss-Commerce-License.txt
 */
namespace Bss\RewardPointGraphQl\Model\Resolver;

use Bss\RewardPoint\Block\Customer\RewardPoint;
use Bss\RewardPoint\Model\ResourceModel\Notification;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

/**
 * Class CustomerRewardPoint
 *
 * @package Bss\RewardPointGraphQl\Model\Resolver
 */
class CustomerRewardPoint implements ResolverInterface
{
    /**
     * @var RewardPoint
     */
    protected $rewardPoint;

    /**
     * @var Notification
     */
    protected $notification;

    /**
     * CustomerRewardPoint constructor.
     * @param RewardPoint $rewardPoint
     * @param Notification $notification
     */
    public function __construct(
        RewardPoint $rewardPoint,
        Notification $notification
    ) {
        $this->rewardPoint = $rewardPoint;
        $this->notification = $notification;
    }

    /**
     * Resolve
     *
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array|Value|mixed
     * @throws LocalizedException
     * @throws NoSuchEntityException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $customerId = $context->getUserId();
        $balance_info = $this->getBalanceInfo($customerId);
        $notify = $this->notification->getNotificationByCustomer($customerId);
        $ratePoint = $this->rewardPoint->getRateCurrencytoPoint();
        $result = [];
        $result['point'] = $balance_info->getPointBalance();
        $result['point_used'] = $balance_info->getPointSpent();
        $result['point_expired'] = $balance_info->getPointExpired();
        $result['amount'] = $balance_info->getAmount();
        $result['notify_balance'] = $notify['notify_balance'];
        $result['notify_expiration'] = $notify['notify_expiration'];
        $result['rate_point'] = $ratePoint;
        return $result;
    }

    /**
     * Get balance info
     *
     * @param int $customerId
     * @return \Bss\RewardPoint\Model\Transaction
     * @throws NoSuchEntityException|LocalizedException
     */
    public function getBalanceInfo($customerId)
    {
        $websiteId = $this->rewardPoint->getWebsiteId();

        return $this->rewardPoint->getTransaction()->loadByCustomer($customerId, $websiteId);
    }
}
