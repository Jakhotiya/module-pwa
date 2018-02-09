<?php
namespace Magecrafts\WebApp\Model;

use Magecrafts\WebApp\Api\Data\NotificationInterface;
use Magento\Framework\Model\AbstractModel;

class Notification extends AbstractModel implements NotificationInterface
{

    protected function _construct()
    {
        $this->_init('Magecrafts\WebApp\Model\ResourceModel\Notification');
    }


   public function setType($type){
        $this->setData('type',$type);
   }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getData('title');
    }



    public function setPayload($payload){
        if(is_array($payload)){
            $this->setData('payload',json_encode($payload));
        }else{
            $this->setData('payload',$payload);
        }

    }


    /**
     * Return a json encoded string
     * @return string
     */
    public function getPayload()
    {
        return $this->getData('payload');
    }
}
