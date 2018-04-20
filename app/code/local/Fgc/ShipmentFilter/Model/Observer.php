<?php
class Fgc_ShipmentFilter_Model_Observer {
	public function salesQuoteCollectTotalsBefore(Varien_Event_Observer $observer) {
		// Mage::dispatchEvent('admin_session_user_login_success', array('user'=>$user));
		// $user = $observer->getEvent()->getUser();
		// $user->doSomething();
		/**
		 * @var Mage_Sales_Model_Quote $quote
		 */
		//$quote = $observer->getQuote();
		//$ShippingTaxAmount = $quote->getShippingAddress();//->getShippingTaxAmount();
		//exit($ShippingTaxAmount);

		$quote = Mage::getModel("checkout/session")->getQuote();
		$store = Mage::app()->getStore($quote->getStoreId());

		//$address = $quote->getShippingAddress();
		//$amount = $address->getShippingAmount();
		/* $delCost = 10.23;

		$quote->getShippingAddress()->setShippingAmount($delCost);
		$quote->getShippingAddress()->setBaseShippingAmount($delCost);
		$quote->getShippingAddress()->setData('price',$delCost);
		$quote->getShippingAddress()->setRate($delCost);
		$quote->getShippingAddress()->setCost($delCost);
		$quote->save();

		var_dump($quote->getShippingAddress()->getData()); */

		$carriers = Mage::getStoreConfig('carriers', $store);
		foreach ($carriers as $carrierCode => $carrierConfig) {
			//if ($carrierCode == 'premiumrate') {
				//Mage::log('Handling Fee(Before):' . $store->getConfig ( "carriers/{$carrierCode}/handling_fee" ), null, 'shipping-price.log');
				//Mage::log('Price(Before):' . $store->getConfig ( "carriers/{$carrierCode}/price" ), null, 'shipping-price.log');
				$store->setConfig("carriers/{$carrierCode}/handling_type", 'P'); // F - Fixed, P - Percentage
				$store->setConfig("carriers/{$carrierCode}/handling_fee", 10);
				// ##If you want to set the price instead of handling fee you can simply use as:
				//$store->setConfig("carriers/{$carrierCode}/price", 100);

				//Mage::log('Handling Fee(After):' . $store->getConfig ( "carriers/{$carrierCode}/handling_fee" ), null, 'shipping-price.log');
				//Mage::log('Price(After):' . $store->getConfig ( "carriers/{$carrierCode}/price" ), null, 'shipping-price.log');
			//}
		}
	}
}
