<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subject
 *
 * @ORM\Table(name="subject")
 * @ORM\Entity
 */
class Subject
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="obligatory", type="integer", nullable=false)
     */
    private $obligatory;

    /**
     * @var integer
     *
     * @ORM\Column(name="idsubject", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsubject;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Subject
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set obligatory
     *
     * @param integer $obligatory
     *
     * @return Subject
     */
    public function setObligatory($obligatory)
    {
        $this->obligatory = $obligatory;

        return $this;
    }

    /**
     * Get obligatory
     *
     * @return integer
     */
    public function getObligatory()
    {
        return $this->obligatory;
    }

    /**
     * Get idsubject
     *
     * @return integer
     */
    public function getIdsubject()
    {
        return $this->idsubject;
    }
    public function  __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getName();
    }
}
