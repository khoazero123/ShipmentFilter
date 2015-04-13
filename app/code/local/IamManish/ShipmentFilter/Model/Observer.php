<?php
class IamManish_ShipmentFilter_Model_Observer {
	public function salesQuoteCollectTotalsBefore(Varien_Event_Observer $observer) {
		// Mage::dispatchEvent('admin_session_user_login_success', array('user'=>$user));
		// $user = $observer->getEvent()->getUser();
		// $user->doSomething();
		/**
		 * @var Mage_Sales_Model_Quote $quote
		 */
		$quote = $observer->getQuote ();
		$someConditions = true; // this can be any condition based on your requirements
		$newHandlingFee = 25;
		$newPrice = 25;
		$store = Mage::app ()->getStore ( $quote->getStoreId () );
		$carriers = Mage::getStoreConfig ( 'carriers', $store );
		foreach ( $carriers as $carrierCode => $carrierConfig ) {
			if ($carrierCode == 'flatrate') {
				if ($someConditions) {
					Mage::log ( 'Handling Fee(Before):' . $store->getConfig ( "carriers/{$carrierCode}/handling_fee" ), null, 'shipping-price.log' );
					$store->setConfig ( "carriers/{$carrierCode}/handling_type", 'O' ); // F - Fixed, P - Percentage
					//$store->setConfig ( "carriers/{$carrierCode}/handling_fee", $newHandlingFee );
					
					// ##If you want to set the price instead of handling fee you can simply use as:
					$store->setConfig("carriers/{$carrierCode}/price", $newPrice);
					
					Mage::log ( 'Handling Fee(After):' . $store->getConfig ( "carriers/{$carrierCode}/handling_fee" ), null, 'shipping-price.log' );
				}
			}
		}
	}
}
