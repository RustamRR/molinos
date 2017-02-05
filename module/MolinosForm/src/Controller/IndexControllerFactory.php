<?php

namespace MolinosForm\Controller;

use MolinosForm\Controller\IndexController;
use MolinosForm\Service\FeedbackService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class IndexControllerFactory
 * @package MolinosForm\Controller
 */
class IndexControllerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $parentLocator = $serviceLocator->getServiceLocator();
        $service = $parentLocator->get(FeedbackService::class);

        return new IndexController($service);
    }
}