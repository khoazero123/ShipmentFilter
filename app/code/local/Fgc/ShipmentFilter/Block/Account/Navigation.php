<?php

class Fgc_ShipmentFilter_Block_Account_Navigation extends Mage_Customer_Block_Account_Navigation {
    public function removeLinkByName($name){
        unset($this->_links[$name]);
        return $this;
    }
}
