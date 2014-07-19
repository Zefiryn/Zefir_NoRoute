<?php

class Zefir_NoRoute_Model_Observer {

    public function setCMSPageResponseCode(Varien_Event_Observer $observer) {
        $page = $observer->getEvent()->getPage();
        $controller = $observer->getEvent()->getControllerAction();
        if ($page->getIdentifier() == Mage::getStoreConfig('web/default/cms_no_route')) {
            $controller->getResponse()->setHttpResponseCode(404);
            
            //cache do not save response code so we cannot cache this request
            //otherwise it will always set 200
            $cache = Mage::app()->getCacheInstance();
            $cache->banUse('full_page');
        }
    }
}
