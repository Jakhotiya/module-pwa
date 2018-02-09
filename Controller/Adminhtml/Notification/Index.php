<?php

namespace Magecrafts\WebApp\Controller\Adminhtml\Notification;

class Index extends \Magecrafts\WebApp\Controller\Adminhtml\AbstractAction
{
    protected $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->resultPageFactory->create();
    }

}
