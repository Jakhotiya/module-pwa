<?php

namespace Magecrafts\WebApp\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ManifestDeployCommand extends \Symfony\Component\Console\Command\Command
{
    /**
     * @var \Magento\Framework\App\State
     */
    protected $appState;
    /**
     * @var \Humc\Theme\Model\DeployManifest
     */
    private $deployManifest;

    public function __construct(
        \Magento\Framework\App\State $appState,
        \Magecrafts\WebApp\Model\DeployManifest $deployManifest
    ) {
        $this->appState = $appState;
        $this->deployManifest = $deployManifest;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     * @throws \InvalidArgumentException
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function configure()
    {
        $this->setName('setup:manifest:deploy')
            ->setDescription('Deploys manifest json for progressive web app');

        parent::configure();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $this->appState->setAreaCode(\Magento\Framework\App\Area::AREA_FRONTEND);
        $this->deployManifest->deploy('frontend','Avactis/digicenter','en_US');
    }
}
