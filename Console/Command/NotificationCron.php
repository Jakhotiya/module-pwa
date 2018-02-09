<?php

namespace Magecrafts\WebApp\Console\Command;

use Magecrafts\WebApp\Model\PushService;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class NotificationCron extends \Symfony\Component\Console\Command\Command
{
    /**
     * @var \Magento\Framework\App\State
     */
    protected $appState;
    /**
     * @var \Humc\Theme\Model\DeployManifest
     */
    private $deployManifest;
    /**
     * @var \Magecrafts\WebApp\Model\ResourceModel\Notification
     */
    private $resource;
    /**
     * @var \Magecrafts\WebApp\Model\NotificationFactory
     */
    private $notificationFactory;
    /**
     * @var PushService
     */
    private $pushService;

    public function __construct(
        \Magento\Framework\App\State $appState,
        \Magecrafts\WebApp\Model\ResourceModel\Notification $resource,
        \Magecrafts\WebApp\Model\NotificationFactory $notificationFactory,
        PushService $pushService
    ) {
        parent::__construct();
        $this->appState = $appState;
        $this->resource = $resource;
        $this->notificationFactory = $notificationFactory;
        $this->pushService = $pushService;
    }

    /**
     * {@inheritdoc}
     * @throws \InvalidArgumentException
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function configure()
    {
        $this->setName('cron:notification')
            ->setDescription('Sends unsent notifications');

        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $this->appState->setAreaCode(\Magento\Framework\App\Area::AREA_CRONTAB);
        //get not sent notifications from pwa_user_notifications
        //create notification object
        //send notification using notification service
    }
}
