<?php

namespace MolinosForm\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Answer
 * @package MolinosForm\Entity
 *
 * @ORM\Entity(repositoryClass="AnswerRepository")
 * @ORM\Table(name="answer")
 */

class Answer
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(name="text", type="text", nullable=false)
     */
    protected $text;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    public function __construct($text)
    {
        $this->setText($text);
    }
}