<?php

namespace Magecrafts\WebApp\Api\Data;


interface NotificationInterface
{
    const TYPE_PRODUCT = 'product';

    const TYPE_ORDER = 'order';

    const TYPE_PROMOTION = 'promotion';


    /**
     * @return string
     */
    public function getTitle();

    /**
     * Return a json encoded string
     * @return string
     */
    public function getPayload();

}