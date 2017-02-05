<?php

namespace MolinosForm\Controller;


use MolinosForm\Service\FeedbackService;

/**
 * Interface IndexControllerInterface
 * @package MolinosForm\Controller
 */
interface IndexControllerInterface
{

    public function indexAction();

    public function getService();
    
    public function __construct(FeedbackService $feedbackService);
}