<?php

namespace Magecrafts\WebApp\Controller\Adminhtml\Notification;


use Magento\Backend\App\Action;

class Add extends \Magecrafts\WebApp\Controller\Adminhtml\AbstractAction
{
    /**
     * @var \Magecrafts\WebApp\Model\NotificationFactory
     */
    private $notificationFactory;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    public function __construct(Action\Context $context,
                                \Magento\Framework\View\Result\PageFactory $resultPageFactory,
                                \Magecrafts\WebApp\Model\NotificationFactory $notificationFactory)
    {
        parent::__construct($context);
        $this->notificationFactory = $notificationFactory;
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}