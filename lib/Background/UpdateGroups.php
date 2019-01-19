<?php
namespace OCA\ConcrexitAuth\Background;

use OCP\BackgroundJob\Job;
use OCA\ConcrexitAuth\AppInfo\Application;
use OCP\ILogger;
use OCP\AppFramework\Utility\ITimeFactory;

class UpdateGroups extends Job {

    protected $logger;
    protected $appName;

    /**
     * @param ILogger $logger
     * @param ITimeFactory $timeFactory
     * @param string $timeFactory
     */
    public function __construct(ILogger $logger, ITimeFactory $timeFactory, string $appName) {
        parent::__construct($timeFactory);
        $this->logger = $logger;
        $this->appName = $appName;
    }

    public function run($argument) {
        $this->logger->debug('Running UpdateGroupsJob', array('app' => $this->appName));
        $app = new Application();
        $container = $app->getContainer();
        $container->query('GroupBackend')->updateGroups();
    }
    
}