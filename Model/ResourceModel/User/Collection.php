<?php
namespace Magecrafts\WebApp\Model\ResourceModel\User;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Magecrafts\WebApp\Model\User','Magecrafts\WebApp\Model\ResourceModel\User');
    }
}
