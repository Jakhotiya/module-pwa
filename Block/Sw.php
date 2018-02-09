<?php

namespace Magecrafts\WebApp\Block;


use Magento\Framework\View\Element\Template;

class Sw extends \Magento\Framework\View\Element\Template
{

    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getPublicKey(){
        return $this->_scopeConfig->getValue('pwa/notifications/pubkey');
    }


}