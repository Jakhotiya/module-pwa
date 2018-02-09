<?php
namespace Magecrafts\WebApp\Model\ResourceModel\Notification;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Magecrafts\WebApp\Model\Notification','Magecrafts\WebApp\Model\ResourceModel\Notification');
    }
}
