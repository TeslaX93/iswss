<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teacher
 *
 * @ORM\Table(name="teacher", indexes={@ORM\Index(name="fk_teacher_employee1_idx", columns={"idemployee"}), @ORM\Index(name="fk_teacher_schoolclass1_idx", columns={"idschoolclass"})})
 * @ORM\Entity
 */
class Teacher
{
    /**
     * @var integer
     *
     * @ORM\Column(name="isActive", type="integer", nullable=false)
     */
    private $isactive;

    /**
     * @var integer
     *
     * @ORM\Column(name="idteacher", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idteacher;

    /**
     * @var \AppBundle\Entity\Schoolclass
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Schoolclass")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idschoolclass", referencedColumnName="idschoolclass")
     * })
     */
    private $idschoolclass;

    /**
     * @var \AppBundle\Entity\Employee
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idemployee", referencedColumnName="idemployee")
     * })
     */
    private $idemployee;



    /**
     * Set isactive
     *
     * @param integer $isactive
     *
     * @return Teacher
     */
    public function setIsactive($isactive)
    {
        $this->isactive = $isactive;

        return $this;
    }

    /**
     * Get isactive
     *
     * @return integer
     */
    public function getIsactive()
    {
        return $this->isactive;
    }

    /**
     * Get idteacher
     *
     * @return integer
     */
    public function getIdteacher()
    {
        return $this->idteacher;
    }

    /**
     * Set idschoolclass
     *
     * @param \AppBundle\Entity\Schoolclass $idschoolclass
     *
     * @return Teacher
     */
    public function setIdschoolclass(\AppBundle\Entity\Schoolclass $idschoolclass = null)
    {
        $this->idschoolclass = $idschoolclass;

        return $this;
    }

    /**
     * Get idschoolclass
     *
     * @return \AppBundle\Entity\Schoolclass
     */
    public function getIdschoolclass()
    {
        return $this->idschoolclass;
    }

    /**
     * Set idemployee
     *
     * @param \AppBundle\Entity\Employee $idemployee
     *
     * @return Teacher
     */
    public function setIdemployee(\AppBundle\Entity\Employee $idemployee = null)
    {
        $this->idemployee = $idemployee;

        return $this;
    }

    /**
     * Get idemployee
     *
     * @return \AppBundle\Entity\Employee
     */
    public function getIdemployee()
    {
        return $this->idemployee;
    }
}
