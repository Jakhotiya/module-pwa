<?php

namespace Magecrafts\WebApp\Api;


use Magecrafts\WebApp\Api\Data\NotificationInterface;

interface PushInterface
{

    public function push(NotificationInterface $notification);

}