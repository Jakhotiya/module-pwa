<?php

namespace Magecrafts\WebApp\Model;


use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\ObjectManagerInterface;
use \Minishlink\WebPush\WebPush;

class WebPushFactory
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function create(){
        $scopeConfig = $this->objectManager->get(ScopeConfigInterface::class);
        $auth = [
            'VAPID'=>[
                'subject' => $scopeConfig->get('web/secure/base_url'),
                'publicKey' => $scopeConfig->getValue('pwa/notifications/pubkey'),
                'privateKey' => $scopeConfig->getValue('pwa/notifications/privekey'),
            ]
        ];
       return $this->objectManager->create(WebPush::class,['auth'=>$auth]);
    }
}