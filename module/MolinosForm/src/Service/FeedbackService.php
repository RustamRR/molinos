<?php

namespace MolinosForm\Service;

use Doctrine\ORM\EntityManager;
use MolinosForm\Entity\Answer;
use MolinosForm\Entity\Document;
use MolinosForm\Entity\Feedback;

/**
 * Class FeedbackService
 * @package MolinosForm\Service
 */
class FeedbackService implements FeedbackServiceInterface
{
    /** @var  EntityManager */
    protected $entityManager;
    /** @var  Feedback */
    protected $feedbackRepository;
    /** @var  Document */
    protected $documentRepository;
    /** @var  Answer */
    protected $answerRepository;

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param EntityManager $em
     * @return $this
     */
    public function setEntityManager(EntityManager $em)
    {
        $this->entityManager = $em;
        return $this;
    }

    /**
     * @param Feedback $feedbackRepository
     */
    public function setFeedbackRepository($feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /**
     * @return Feedback
     */
    public function getFeedbackRepository()
    {
        return $this->feedbackRepository;
    }

    /**
     * @param Document $documentRepository
     */
    public function setDocumentRepository($documentRepository)
    {
        $this->documentRepository = $documentRepository;
    }

    /**
     * @return Document
     */
    public function getDocumentRepository()
    {
        return $this->documentRepository;
    }

    /**
     * @param Answer $answerRepository
     */
    public function setAnswerRepository($answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    /**
     * @return Answer
     */
    public function getAnswerRepository()
    {
        return $this->answerRepository;
    }

    /**
     * FeedbackService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em, $feedbackRepository, $documentRepository, $answerRepository)
    {
        $this->setEntityManager($em);
        $this->setFeedbackRepository($feedbackRepository);
        $this->setDocumentRepository($documentRepository);
        $this->setAnswerRepository($answerRepository);
    }

    public function saveFile($fileData)
    {
        $image = $fileData;

        $this->getEntityManager()->persist($image);
        $this->getEntityManager()->flush($image);

        return $image;
    }

    public function saveFeedback(Feedback $data)
    {
        $this->getEntityManager()->persist($data);
        $this->getEntityManager()->flush($data);
    }

    public function getFeedbacks()
    {
        $feeds = [];
        $feedbacks = $this->getFeedbackRepository()->findAll();
        foreach ($feedbacks as $feedback){
            $feeds[] = [
                'id' => $feedback->getId(),
                'name' => $feedback->getName(),
                'question' => $feedback->getQuestion()
            ];
        }
        return $feeds;
    }

    public function getFeedback($id)
    {
        $feed = [];
        $feedback = $this->getFeedbackRepository()->find($id);
        $feed['id'] = $feedback->getId();
        $feed['name'] = $feedback->getName();
        $feed['question'] = $feedback->getQuestion();
        $feed['email'] = $feedback->getEmail();
        $feed['image'] = $feedback->getImage()->getName();
        if(!is_null($feedback->getAnswer()))
            $feed['answer'] = $feedback->getAnswer()->getText();
        return $feed;
    }

    public function removeFeedback($id)
    {
        $feedback = $this->getFeedbackRepository()->find($id);

        $this->getEntityManager()->remove($feedback);
        $this->getEntityManager()->flush();
    }

    public function sendMail($htmlBody, $textBody, $subject, $from, $to)
    {
        
    }


    public function saveAnswer($feedback, $data)
    {
        if (!is_null($data["answerText"])){
            $answer = new Answer($data["answerText"]);
            $this->getEntityManager()->persist($answer);
            $this->getEntityManager()->flush($answer);

            $feed = $this->getFeedbackRepository()->find($feedback["id"]);
            $feed->setAnswer($answer);
            $this->getEntityManager()->persist($feed);
            $this->getEntityManager()->flush($feed);

            return true;
        }
        return false;
    }
}