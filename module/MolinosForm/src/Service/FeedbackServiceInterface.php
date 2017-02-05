<?php

namespace MolinosForm\Service;


use Doctrine\ORM\EntityManager;
use MolinosForm\Entity\Feedback;

/**
 * Interface FeedbackServiceInterface
 * @package MolinosForm\Service
 */
interface FeedbackServiceInterface
{
    public function getEntityManager();

    public function setEntityManager(EntityManager $em);

    public function __construct(EntityManager $em, $feedbackRepository, $documentRepository, $answerRepository);

    public function saveFile($fileData);

    public function saveFeedback(Feedback $data);

    public function getFeedbacks();

    public function getFeedback($id);

    public function saveAnswer($feedback, $data);

    public function removeFeedback($id);

    public function sendMail($htmlBody, $textBody, $subject, $from, $to);
}