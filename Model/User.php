<?php
namespace Magecrafts\WebApp\Model;


class User extends \Magento\Framework\Model\AbstractModel
{

    protected function _construct()
    {
        $this->_init('Magecrafts\WebApp\Model\ResourceModel\User');
    }


}
