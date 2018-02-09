<?php

namespace Magecrafts\WebApp\Controller\Adminhtml;


abstract class AbstractAction extends \Magento\Backend\App\Action
{

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magecrafts_WebApp::top');
    }

}