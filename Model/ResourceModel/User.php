<?php
namespace Magecrafts\WebApp\Model\ResourceModel;


class User extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('pwa_users','user_id');
    }
}
