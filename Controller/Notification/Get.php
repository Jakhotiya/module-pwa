<?php

namespace Magecrafts\WebApp\Controller\Notification;


use Magecrafts\WebApp\Model\UserFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Get extends Action
{


    public function execute()
    {

            $data = ['title'=>'Service workers','body'=>'You will need to fetch the data from database'];

        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        return $result->setData($data);
    }


}