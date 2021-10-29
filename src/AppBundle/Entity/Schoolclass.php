<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Schoolclass
 *
 * @ORM\Table(name="schoolclass", indexes={@ORM\Index(name="fk_schoolclass_school1_idx", columns={"idschool"})})
 * @ORM\Entity
 */
class Schoolclass
{
    /**
     * @var integer
     *
     * @ORM\Column(name="startYear", type="integer", nullable=false)
     */
    private $startyear;

    /**
     * @var integer
     * @Assert\Regex(pattern="/[0-9]+/i",message="To pole nie może zawierać liter")
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var string
     * @Assert\Regex(pattern="/[A-Z]+/i",message="To pole nie może zawierać cyfr")
     * @ORM\Column(name="letter", type="string", length=5, nullable=true)
     */
    private $letter;

    /**
     * @var integer
     *
     * @ORM\Column(name="idschoolclass", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idschoolclass;

    /**
     * @var \AppBundle\Entity\School
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\School")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idschool", referencedColumnName="idschool")
     * })
     */
    private $idschool;



    /**
     * Set startyear
     *
     * @param integer $startyear
     *
     * @return Schoolclass
     */
    public function setStartyear($startyear)
    {
        $this->startyear = $startyear;

        return $this;
    }

    /**
     * Get startyear
     *
     * @return integer
     */
    public function getStartyear()
    {
        return $this->startyear;
    }

    /**
     * Set number
     *
     * @param integer $number
     *
     * @return Schoolclass
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set letter
     *
     * @param string $letter
     *
     * @return Schoolclass
     */
    public function setLetter($letter)
    {
        $this->letter = $letter;

        return $this;
    }

    /**
     * Get letter
     *
     * @return string
     */
    public function getLetter()
    {
        return $this->letter;
    }

    /**
     * Get idschoolclass
     *
     * @return integer
     */
    public function getIdschoolclass()
    {
        return $this->idschoolclass;
    }

    /**
     * Set idschool
     *
     * @param \AppBundle\Entity\School $idschool
     *
     * @return Schoolclass
     */
    public function setIdschool(\AppBundle\Entity\School $idschool = null)
    {
        $this->idschool = $idschool;

        return $this;
    }

    /**
     * Get idschool
     *
     * @return \AppBundle\Entity\School
     */
    public function getIdschool()
    {
        return $this->idschool;
    }
    public function  __toString()
    {
        // TODO: Implement __toString() method.
        return ($this->getNumber()." ".$this->getLetter());
    }
}
