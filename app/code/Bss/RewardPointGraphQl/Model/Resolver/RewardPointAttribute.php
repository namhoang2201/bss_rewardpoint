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

use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

/**
 * Class RewardPointAttribute
 *
 * @package Bss\RewardPointGraphQl\Model\Resolver
 */
class RewardPointAttribute implements ResolverInterface
{
    /**
     * @var ProductRepository
     */
    protected $product;

    /**
     * RewardPointAttribute constructor.
     *
     * @param ProductRepository $product
     */
    public function __construct(
        ProductRepository $product
    ) {
        $this->product = $product;
    }

    /**
     * Reward Point Attribute
     *
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array|Value|mixed
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @throws NoSuchEntityException
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $result = [];
        $productId = $value['entity_id'];
        $product = $this->product->getById($productId);
        $result['assign_by'] = $product->getData('assign_by');
        $result['receive_point'] = $product->getData('receive_point');
        $result['dependent_qty'] = $product->getData('dependent_qty');
        return $result;
    }
}
