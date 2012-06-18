<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class jubianchiBehatViewerBundleEntityProjectProxy extends \jubianchi\BehatViewerBundle\Entity\Project implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }
    
    
    public function getId()
    {
        $this->__load();
        return parent::getId();
    }

    public function setName($name)
    {
        $this->__load();
        return parent::setName($name);
    }

    public function getName()
    {
        $this->__load();
        return parent::getName();
    }

    public function setBaseUrl($baseUrl)
    {
        $this->__load();
        return parent::setBaseUrl($baseUrl);
    }

    public function getBaseUrl()
    {
        $this->__load();
        return parent::getBaseUrl();
    }

    public function setOutputPath($outputPath)
    {
        $this->__load();
        return parent::setOutputPath($outputPath);
    }

    public function getOutputPath()
    {
        $this->__load();
        return parent::getOutputPath();
    }

    public function setRootPath($rootPath)
    {
        $this->__load();
        return parent::setRootPath($rootPath);
    }

    public function getRootPath()
    {
        $this->__load();
        return parent::getRootPath();
    }

    public function addBuild(\jubianchi\BehatViewerBundle\Entity\Build $builds)
    {
        $this->__load();
        return parent::addBuild($builds);
    }

    public function getBuilds()
    {
        $this->__load();
        return parent::getBuilds();
    }

    public function setSlug($slug)
    {
        $this->__load();
        return parent::setSlug($slug);
    }

    public function getSlug()
    {
        $this->__load();
        return parent::getSlug();
    }

    public function addDefinition(\jubianchi\BehatViewerBundle\Entity\Definition $definitions)
    {
        $this->__load();
        return parent::addDefinition($definitions);
    }

    public function getDefinitions()
    {
        $this->__load();
        return parent::getDefinitions();
    }

    public function setTestCommand($testCommand)
    {
        $this->__load();
        return parent::setTestCommand($testCommand);
    }

    public function getTestCommand()
    {
        $this->__load();
        return parent::getTestCommand();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'name', 'slug', 'base_url', 'output_path', 'root_path', 'test_command', 'builds', 'definitions');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}