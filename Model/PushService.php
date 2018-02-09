<?php

namespace Magecrafts\WebApp\Model;


use Magecrafts\WebApp\Api\Data\NotificationInterface;
use Magecrafts\WebApp\Api\PushInterface;

class PushService implements PushInterface
{

    /**
     * @var \Minishlink\WebPush\WebPush
     */
    private $webPush;

    public function __construct(WebPushFactory $webPushFactory )
    {
        $this->webPush = $webPushFactory->create();
    }

    public function push(NotificationInterface $notification)
    {
        $this->webPush->sendNotification(
            $notification->getEndpoint(),
            $notification->getPayload() // optional (defaults null)
        );
        $this->webPush->flush();
    }
}