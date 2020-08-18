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

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

/**
 * Class GetModuleConfigs
 *
 * @package Bss\RewardPointGraphQl\Model\Resolver
 */
class GetModuleConfigs implements ResolverInterface
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * GetModuleConfigs constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
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
     * @throws GraphQlInputException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $result = [];
        if (empty($args['storeview'])) {
            throw new GraphQlInputException(__('"%1" value should be specified.', "storeview"));
        }
        $storeId = $args['storeview'];
        $configs = $this->getConfig($storeId);
        if ($configs) {
            if (isset($configs['general']['maximum_threshold'])) {
                $maximumThreshold = $configs['general']['maximum_threshold'];
            } else {
                $maximumThreshold = null;
            }
            if (isset($configs['general']['expire_day'])) {
                $expireDay = $configs['general']['expire_day'];
            } else {
                $expireDay = null;
            }
            if (isset($configs['general']['maximum_earn_order'])) {
                $maximumEarnOrder = $configs['general']['maximum_earn_order'];
            } else {
                $maximumEarnOrder = null;
            }
            if (isset($configs['earning_point']['maximum_point_order'])) {
                $maximumPointOrder = $configs['earning_point']['maximum_point_order'];
            } else {
                $maximumPointOrder = null;
            }
            if (isset($configs['earning_point']['maximum_earn_review'])) {
                $maximumEarnReview = $configs['earning_point']['maximum_earn_review'];
            } else {
                $maximumEarnReview = null;
            }
            $result['active'] = (int) $configs['general']['active'];
            $result['redeem_threshold'] = $configs['general']['redeem_threshold'];
            $result['maximum_threshold'] = $maximumThreshold;
            $result['expire_day'] = $expireDay;
            $result['earn_tax'] = $configs['earning_point']['earn_tax'];
            $result['earn_shipping'] = $configs['earning_point']['earn_shipping'];
            $result['earn_order_paid'] = $configs['earning_point']['earn_order_paid'];
            $result['maximum_earn_order'] = $maximumEarnOrder;
            $result['maximum_earn_review'] = $maximumEarnReview;
            $result['auto_refund'] = $configs['earning_point']['auto_refund'];
            $result['maximum_point_order'] = $maximumPointOrder;
            $result['allow_spend_tax'] = $configs['spending_point']['allow_spend_tax'];
            $result['allow_spend_shipping'] = $configs['spending_point']['allow_spend_shipping'];
            $result['restore_spent'] = $configs['spending_point']['restore_spent'];
            $result['point_icon'] = $configs['frontend']['point_icon'];
            $result['sw_point_header'] = $configs['frontend']['sw_point_header'];
            $result['point_mess_register'] = $configs['frontend']['point_mess_register'];
            $result['point_subscrible'] = $configs['frontend']['point_subscrible'];
            $result['cart_order_summary'] = $configs['frontend']['cart_order_summary'];
            $result['product_page_tab_review'] = $configs['frontend']['product_page_tab_review'];
            $result['product_page_reward_point'] = $configs['frontend']['product_page_reward_point'];
            $result['cate_page_reward_point'] = $configs['frontend']['cate_page_reward_point'];
            $result['point_slider'] = $configs['frontend']['point_slider'];
            $result['sender'] = $configs['email_notification']['sender'];
            $result['earn_point_template'] = $configs['email_notification']['earn_point_template'];
            $result['spend_point_template'] = $configs['email_notification']['spend_point_template'];
            $result['expiry_warning_template'] = $configs['email_notification']['expiry_warning_template'];
            $result['expire_day_before'] = $configs['email_notification']['expire_day_before'];
            $result['subscrible'] = $configs['email_notification']['subscrible'];
        }
        return $result;
    }

    /**
     * Get module config
     *
     * @param int $websiteId
     * @return mixed
     */
    protected function getConfig($websiteId = null)
    {
        return $this->scopeConfig->getValue(
            'bssrewardpoint',
            \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE,
            $websiteId
        );
    }
}

