<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grade
 *
 * @ORM\Table(name="grade", indexes={@ORM\Index(name="fk_grade_student1_idx", columns={"idstudent"}), @ORM\Index(name="fk_grade_subject1_idx", columns={"idsubject"})})
 * @ORM\Entity
 */
class Grade
{
    /**
     * @var float
     *
     * @ORM\Column(name="grade", type="float", precision=10, scale=0, nullable=false)
     */
    private $grade;

    /**
     * @var integer
     *
     * @ORM\Column(name="idgrade", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgrade;

    /**
     * @var \AppBundle\Entity\Subject
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Subject")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idsubject", referencedColumnName="idsubject")
     * })
     */
    private $idsubject;

    /**
     * @var \AppBundle\Entity\Student
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Student")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idstudent", referencedColumnName="idstudent")
     * })
     */
    private $idstudent;



    /**
     * Set grade
     *
     * @param float $grade
     *
     * @return Grade
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return float
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Get idgrade
     *
     * @return integer
     */
    public function getIdgrade()
    {
        return $this->idgrade;
    }

    /**
     * Set idsubject
     *
     * @param \AppBundle\Entity\Subject $idsubject
     *
     * @return Grade
     */
    public function setIdsubject(\AppBundle\Entity\Subject $idsubject = null)
    {
        $this->idsubject = $idsubject;

        return $this;
    }

    /**
     * Get idsubject
     *
     * @return \AppBundle\Entity\Subject
     */
    public function getIdsubject()
    {
        return $this->idsubject;
    }

    /**
     * Set idstudent
     *
     * @param \AppBundle\Entity\Student $idstudent
     *
     * @return Grade
     */
    public function setIdstudent(\AppBundle\Entity\Student $idstudent = null)
    {
        $this->idstudent = $idstudent;

        return $this;
    }

    /**
     * Get idstudent
     *
     * @return \AppBundle\Entity\Student
     */
    public function getIdstudent()
    {
        return $this->idstudent;
    }





    public function  __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getIdsubject()." ".$this->getGrade();
    }
}
