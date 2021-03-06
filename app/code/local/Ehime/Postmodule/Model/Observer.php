<?php
Class Ehime_Postmodule_Model_Observer
{
    public function ping(Varien_Event_Observer $observer)
    {
        $eventName = $observer->getEvent()->getName();
        $configuredEvent = Mage::getStoreConfig('the/path/here');

        if ($configuredEvent !== $eventName)
        {
            return;
        }

        $data = $observer->getData('order_ids');
        $url  = 'http://foo.com'; // needs to be fetched...

        try
        {
            $client = New Zend_Http_Client($url);

            $client->setRawData(json_encode($data), 'application/json')->request('POST');

            var_dump($client->request()->getBody());

            Mage::log('Order has been sent to foo.com');

        } catch (Exception $e) {
            Mage::logException($e);
        }

        return $this;
    }

    /**
     * SHTF and needs to be cron'd i guess
     */
    private function pong()
    {
        // .....
    }
}