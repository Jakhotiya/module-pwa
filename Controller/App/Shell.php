<?php

namespace Magecrafts\WebApp\Controller\App;


use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\View\Result\PageFactory;

class Shell extends \Magento\Framework\App\Action\Action
{

    /**
     * @var SessionManagerInterface
     */
    private $sessionManager;
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory, SessionManagerInterface $sessionManager)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->sessionManager = $sessionManager;
    }

    public function execute()
    {
        $this->sessionManager->setName('pwa-app');
        return $this->resultPageFactory->create();
    }
}