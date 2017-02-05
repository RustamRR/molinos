<?php

namespace MolinosForm\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Document
 * @package MolinosForm\Entity
 *
 * @ORM\Entity(repositoryClass="DocumentRepository")
 * @ORM\Table(name="document")
 */

class Document
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
     *
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    protected $type;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }


    public function __construct($data = array()){
        $this->setName($data['name']);
        $this->setType($data['type']);
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}