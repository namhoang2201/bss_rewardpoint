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
use Bss\RewardPoint\Model\Config\Source\TransactionActions;

/**
 * Class TransactionType
 * @package Bss\RewardPoint\Ui\Component\Listing\Column
 */
class TransactionType extends Column
{
    /**
     * @var TransactionActions
     */
    protected $actionOption;

    /**
     * TransactionType constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param TransactionActions $actionOption
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        TransactionActions $actionOption,
        array $components = [],
        array $data = []
    ) {
        $this->actionOption = $actionOption;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $actionOption = $this->actionOption->toArray();
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $actionType = $item['action'];
                $item[$this->getData('name')] = isset($actionOption[$actionType]) ? $actionOption[$actionType] : "";
            }
        }
        return $dataSource;
    }
}
