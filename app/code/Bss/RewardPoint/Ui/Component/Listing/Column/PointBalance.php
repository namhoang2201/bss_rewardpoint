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
namespace Bss\RewardPoint\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Bss\RewardPoint\Model\ResourceModel\TransactionFactory;

/**
 * Class CustomerName
 * @package Bss\RewardPoint\Ui\Component\Listing\Column
 */
class PointBalance extends Column
{
    /**
     * @var TransactionFactory
     */
    protected $transactionResource;

    /**
     * PointBalance constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param TransactionFactory $transactionResource
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        TransactionFactory $transactionResource,
        array $components = [],
        array $data = []
    ) {
        $this->transactionResource = $transactionResource;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $lastestBalance = $this->transactionResource->create()->getPointBalanceForGrid(
                    $item['transaction_id']
                );
                $item[$this->getData('name')] = (int) $lastestBalance;
            }
        }
        return $dataSource;
    }
}
