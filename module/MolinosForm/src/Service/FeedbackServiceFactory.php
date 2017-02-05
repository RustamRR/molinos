<?php

namespace MolinosForm\Service;

use Doctrine\ORM\EntityManager;
use MolinosForm\Entity\Answer;
use MolinosForm\Entity\Document;
use MolinosForm\Entity\Feedback;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class FeedbackServiceFactory
 * @package MolinosForm\Service
 */
class FeedbackServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var EntityManager $entityManager */
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');

        //репозитории
        /** @var  $feedbackRepository */
        $feedbackRepository = $em->getRepository(Feedback::class);
        /** @var  $documentRepository */
        $documentRepository = $em->getRepository(Document::class);
        /** @var  $answerRepository */
        $answerRepository = $em->getRepository(Answer::class);

        return new FeedbackService($em, $feedbackRepository, $documentRepository, $answerRepository);
    }
}