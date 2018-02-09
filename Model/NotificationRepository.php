<?php

namespace Magecrafts\WebApp\Model;


class NotificationRepository
{

    /**
     * @var ResourceModel\Notification
     */
    private $notificationResource;

    public function __construct(ResourceModel\Notification $notificationResource)
    {
        $this->notificationResource = $notificationResource;
    }

    public function save(Notification $notification){
        $this->notificationResource->save($notification);
    }

    public function getByEndpoint(){

    }

}