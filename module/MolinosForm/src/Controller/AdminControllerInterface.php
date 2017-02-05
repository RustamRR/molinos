<?php

namespace MolinosForm\Controller;


use Doctrine\ORM\EntityManager;
use MolinosForm\Service\FeedbackService;

/**
 * Interface AdminControllerInterface
 * @package MolinosForm\Controller
 */
interface AdminControllerInterface
{
    public function setService(FeedbackService $service);

    public function getService();

    public function __construct(FeedbackService $service);

    public function indexAction();

    public function viewAction();

    public function removeAction();
}