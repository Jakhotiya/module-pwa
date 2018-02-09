<?php

namespace Magecrafts\WebApp\Controller\Adminhtml\Notification;


use Magento\Backend\App\Action;

class Save extends \Magecrafts\WebApp\Controller\Adminhtml\AbstractAction
{
    /**
     * @var \Magecrafts\WebApp\Model\NotificationFactory
     */
    protected $notificationFactory;
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    public function __construct(Action\Context $context,
                                \Magecrafts\WebApp\Model\NotificationFactory $notificationFactory,
        \Psr\Log\LoggerInterface $logger)
    {
        parent::__construct($context);
        $this->notificationFactory = $notificationFactory;
        $this->logger = $logger;
    }

    public function execute()
    {
        $request = $this->getRequest();
        if($this->validate($request)){
            try{
                $notification = $this->notificationFactory->create();
                $notification->setTitle($request->getParam('title'));
                $notification->setPayload(['message'=>$request->getParam('message')]);
                $notification->save();
                $this->messageManager->addSuccessMessage(__('Notification created'));
            }catch(\Exception $ex){
                $this->logger->critical($ex->getMessage());
                $this->messageManager->addErrorMessage(__('Something went wrong. Please contact the developer'));
            }

        }
        $this->_redirect('*/*/index');

    }

    protected function validate($request){
        return true;
    }
}