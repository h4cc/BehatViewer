<?php

namespace BehatViewer\BehatViewerBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;

class FixtureContext extends BehatViewerContext
{
    private $manager;
    private $connection;
    private $platform;

    public function setKernel(KernelInterface $kernel)
    {
      parent::setKernel($kernel);

      $this->manager = $this->kernel->getContainer()->get('doctrine')->getEntityManager();
      $this->connection = $this->manager->getConnection();
      $this->platform = $this->connection->getDatabasePlatform();
    }

    /**
     * @BeforeScenario @reset
     */
    public function BeforeScenarioReset(\Behat\Behat\Event\EventInterface $event)
    {
        $entities = array(
            'BehatViewerCoreBundle:Step',
            'BehatViewerCoreBundle:Scenario',
            'BehatViewerCoreBundle:Feature',
            'BehatViewerCoreBundle:FeatureStat',
            'BehatViewerCoreBundle:Build',
            'BehatViewerCoreBundle:BuildStat',
            'BehatViewerCoreBundle:Definition',
            'BehatViewerCoreBundle:Project',
            'BehatViewerCoreBundle:User',
            'BehatViewerCoreBundle:Role',
        );

        $this->connection->query(sprintf('SET FOREIGN_KEY_CHECKS = 0;'));

        foreach ($entities as $entity) {
            $this->connection->executeUpdate(
                $this->platform->getTruncateTableSQL(
                    $this->manager->getClassMetadata($entity)->getTableName(),
                    true
                )
            );

            $this->manager->flush();
        }

        $this->BeforeScenarioFixture($event);
    }

    /**
     * @BeforeScenario @fixture
     */
    public function BeforeScenarioFixture(\Behat\Behat\Event\EventInterface $event)
    {
        $tags = array();
        switch (true) {
            case ($event instanceof \Behat\Behat\Event\ScenarioEvent):
                $tags = $event->getScenario()->getTags();
                break;
            case ($event instanceof \Behat\Behat\Event\OutlineEvent):
                $tags = $event->getOutline()->getTags();
                break;
        }

        foreach ($tags as $tag) {
            if (preg_match('/^fixture:(.*)$/', $tag, $match)) {
                $this->iLoadTheFixture($match[1]);
            }
        }
    }

    /**
     * @Given /^I load the "(?P<fixture>[^"]*)" fixture$/
     */
    public function iLoadTheFixture($fixture)
    {
        $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Fixtures';
        $file = $dir . DIRECTORY_SEPARATOR . $fixture;

        if (!file_exists($file)) {
            throw new \RuntimeException(sprintf('Fixture %s does not exist', $fixture));
        }

        $sql = file_get_contents($file);

        try {
            $this->connection->executeUpdate(file_get_contents($file));
        } catch (\PDOException $exception) {
            throw new \RuntimeException($sql, (int) $exception->getCode() ?: 0, $exception);
        }

    }
}
