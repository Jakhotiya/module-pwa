<?php

namespace Magecrafts\WebApp\Api\Data;


interface PushMessageInterface
{

    public function getEndPoint();

    public function getPayload();

    public function getTitle();

}