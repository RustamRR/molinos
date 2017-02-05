<?php

namespace MolinosForm\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Feedback
 * @package MolinosForm\Entity
 *
 * @ORM\Entity(repositoryClass="FeedbackRepository")
 * @ORM\Table(name="feedback")
 */
class Feedback
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Вопрос
     *
     * @var string
     * @ORM\Column(name="question", type="text", nullable=false)
     */
    protected $question;
    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;
    /**
     * @var string
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    protected $email;
    /**
     * @var Document
     *
     * @ORM\OneToOne(targetEntity="\MolinosForm\Entity\Document")
     * @ORM\JoinColumn(name="document_id", referencedColumnName="id", nullable=false)
     */
    protected $image;
    /**
     * @var Answer
     *
     * @ORM\OneToOne(targetEntity="\MolinosForm\Entity\Answer")
     * @ORM\JoinColumn(name="answer_id", referencedColumnName="id", nullable=true)
     */
    protected $answer;
    /**
     * @return integer
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param Document $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return Document
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param Answer $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    /**
     * @return Answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }


    /**
     * @param array $data
     */
    public function exchangeArray($data = array()){
        $image = new Document($data["image"]);
        $this->setQuestion($data['question']);
        $this->setName($data['name']);
        $this->setEmail($data['email']);
        $this->setImage($image);
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}