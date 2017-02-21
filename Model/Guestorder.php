<?php

/**
 * Copyright 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Born\OrderController\Model;

use Born\OrderController\Api\GuestorderInterface;

/**
 * Defines the implementaiton class of the calculator service contract.
 */
class Guestorder implements GuestorderInterface
{
	/**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    protected $orderCollectionFactory;
	
    /**
     * Constructor
     *     
	 * @param \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
     */
    public function __construct(
		\Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
    ) {
		$this->orderCollectionFactory = $orderCollectionFactory;
    }
	
    /**
     * Return mixed.
     *
     * @api
     * @param string $param.
     * @return mixed.
     */
    public function getGuestOrderHistory($param) {
		$arrayData = $this->getJsonArrayOfGuestOrders($param);
		return $arrayData;
    }
	
	/**
     * get guest order collection
     *
     * @return \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
	public function getGuestOrderCollection($param)
	{
		$orderCollecion = $this->orderCollectionFactory
								->create()
								->addFieldToSelect('*');
								
		$orderCollecion->addFieldToFilter(
							'customer_id',
							array(
								'null' => true
							)
						);
						
		if ('all' !== $param){
			$orderCollecion->getSelect()->limit((int)$param);
		}
		
		return $orderCollecion;
	}
	
	/**
     * format guest order collection into array for json object
     */
	public function getJsonArrayOfGuestOrders($param)
	{
		$jsonArray = [];
		$guestOrderCollection = $this->getGuestOrderCollection($param);
		foreach($guestOrderCollection as $_collection){
			$guestOrderHistory['status'] = $_collection->getStatus();
			$guestOrderHistory['total'] = $_collection->getGrandTotal();
			$allVisibleItems = $_collection->getAllVisibleItems();
			$itemArray = [];
			$qtyInvoiced = 0;
			foreach($allVisibleItems as $_item){
				$qtyInvoiced = $qtyInvoiced + $_item->getQtyInvoiced();
				$_itemArray['sku'] = $_item->getSku();
				$_itemArray['item_id'] = $_item->getItemId();
				$_itemArray['price'] = $_item->getRowTotal();
				$_itemArray['qty_invoiced'] = $_item->getQtyInvoiced();
				$_itemArray['qty'] = $_item->getQtyOrdered();
				$itemArray[] = $_itemArray;
			}
			$guestOrderHistory['qty_invoiced'] = $qtyInvoiced;
			$guestOrderHistory['item'] = $itemArray;
			$jsonArray[] = $guestOrderHistory;
		}
		return $jsonArray;
	}
}