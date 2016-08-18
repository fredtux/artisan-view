<?php

namespace Sven\ArtisanView\Tests\Features;

use League\Flysystem\Filesystem;
use Sven\ArtisanView\ViewFactory;
use League\Flysystem\Adapter\Local;
use Symfony\Component\Finder\Finder;
use League\Flysystem\Adapter\NullAdapter;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

abstract class TestCase extends AbstractPackageTestCase
{
    /**
     * Set up the testing suite.
     *
     * @return  null
     */
    public function setUp()
    {
        $adapter = new Local(__DIR__.'/../assets');

        $this->filesystem = new Filesystem($adapter);
        $this->view = new ViewFactory($this->filesystem);
    }

    /**
     * Tear down the application suite.
     *
     * @return  null
     */
    public function tearDown()
    {
        $finder = new Finder;

        foreach ($finder->in(__DIR__.'/../assets') as $file) {
            $file = $file->getRealPath();

            exec("rm -r $file");
        }
    }
}