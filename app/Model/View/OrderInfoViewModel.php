<?php
namespace App\Model\View;

class OrderInfoViewModel extends ViewModelBase
{
	/**
	 * @var int
	 */
	public $id;

    /**
     * @var int
     */
    public $orders_id;

    /**
     * @var string
     */
    public $date_purchased;

    /**
     * @var string
     */
    public $payment_method;

    /**
     * @var string
     */
    public $shipping_method;

	/**
	 * @var AddressViewModel
	 */
	public $orderBillingAddress;

	/**
	 * @var OrderCustomerViewModel
	 */
	public $orderCustomer;

	/**
	 * @var AddressViewModel
	 */
	public $orderShippingAddress;

	/**
	 * @var OrderTotalViewModel[]
	 */
	public $orderTotal;

	/**
	 * @var ProductViewModel
	 */
	public $stockProduct;
}
?>