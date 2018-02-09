<?php
/**
 * Created by PhpStorm.
 * User: abhishek
 * Date: 6/11/17
 * Time: 7:23 PM
 */

namespace Magecrafts\WebApp\Controller\Notification;


use Magecrafts\WebApp\Model\UserFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;

class Subscribe extends Action
{

    /**
     * @var UserFactory
     */
    private $userFactory;

    public function __construct(Context $context, UserFactory $userFactory)
    {
        parent::__construct($context);
        $this->userFactory = $userFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $params = $this->getRequest()->getParams();

        if($this->isValidRequest($params)){
            try{
               $user = $this->userFactory->create();
               $user->setData($params);
               $user->save();
               $data=['success'=>1];
            }catch (\Exception $e){
                $data=['success'=>0,'error'=>$e->getMessage()];
            }

        }else{
            $data = ['success'=>0,'error'=>'invalid request'];
        }

        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        return $result->setData($data);
    }

    protected  function isValidRequest($params){
        return true;
    }
}