<?php
class Fgc_ShipmentFilter_Model_Observer {
	public function salesQuoteCollectTotalsBefore(Varien_Event_Observer $observer) {
		// Mage::dispatchEvent('admin_session_user_login_success', array('user'=>$user));
		// $user = $observer->getEvent()->getUser();
		/**
		 * @var Mage_Sales_Model_Quote $quote
		 */
		//$quote = $observer->getQuote();

		$quote = Mage::getModel("checkout/session")->getQuote();
		$address = $quote->getShippingAddress();

		$amount = $quote->getShippingAddress()->getShippingAmount();
		if($amount > 0) {
			$newPrice = $amount + ($amount * 10 / 100);
			$store = Mage::app()->getStore($quote->getStoreId());
			$carriers = Mage::getStoreConfig('carriers', $store);
			foreach ($carriers as $carrierCode => $carrierConfig) {
				//if ($carrierCode == 'premiumrate') {
					$store->setConfig("carriers/{$carrierCode}/handling_type", 'P'); // F - Fixed, P - Percentage
					$store->setConfig("carriers/{$carrierCode}/handling_fee", 10);
					// ##If you want to set the price instead of handling fee you can simply use as:
					//$store->setConfig("carriers/{$carrierCode}/price", $newPrice);
				//}
			}
		}
	}
}
