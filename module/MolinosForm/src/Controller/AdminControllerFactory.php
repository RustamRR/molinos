<?php

namespace MolinosForm\Controller;


use MolinosForm\Service\FeedbackService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Создаю контроллер через фабрику, чтобы сразу не создавать экземпляр сервиса в обработчиках действий
 * Class AdminControllerFactory
 * @package MolinosForm\Controller
 */
class AdminControllerFactory implements FactoryInterface
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

        return new AdminController($service);
    }
}