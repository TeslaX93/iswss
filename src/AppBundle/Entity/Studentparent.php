<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Studentparent
 *
 * @ORM\Table(name="studentparent", indexes={@ORM\Index(name="fk_studentparent_student1_idx", columns={"idstudent"})})
 * @ORM\Entity
 */
class Studentparent
{
    /**
     * @var string
     *
     * @ORM\Column(name="parentName", type="string", length=45, nullable=false)
     */
    private $parentname;

    /**
     * @var string
     *
     * @ORM\Column(name="parentSurname", type="string", length=45, nullable=false)
     */
    private $parentsurname;

    /**
     * @var string
     *
     * @ORM\Column(name="parentAddress", type="string", length=45, nullable=false)
     */
    private $parentaddress;

    /**
     * @var string
     *
     * @ORM\Column(name="parentPhone", type="string", length=45, nullable=false)
     */
    private $parentphone;

    /**
     * @var string
     *
     * @ORM\Column(name="parentEmail", type="string", length=45, nullable=true)
     */
    private $parentemail;

    /**
     * @var integer
     *
     * @ORM\Column(name="idstudentparent", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idstudentparent;

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
     * Set parentname
     *
     * @param string $parentname
     *
     * @return Studentparent
     */
    public function setParentname($parentname)
    {
        $this->parentname = $parentname;

        return $this;
    }

    /**
     * Get parentname
     *
     * @return string
     */
    public function getParentname()
    {
        return $this->parentname;
    }

    /**
     * Set parentsurname
     *
     * @param string $parentsurname
     *
     * @return Studentparent
     */
    public function setParentsurname($parentsurname)
    {
        $this->parentsurname = $parentsurname;

        return $this;
    }

    /**
     * Get parentsurname
     *
     * @return string
     */
    public function getParentsurname()
    {
        return $this->parentsurname;
    }

    /**
     * Set parentaddress
     *
     * @param string $parentaddress
     *
     * @return Studentparent
     */
    public function setParentaddress($parentaddress)
    {
        $this->parentaddress = $parentaddress;

        return $this;
    }

    /**
     * Get parentaddress
     *
     * @return string
     */
    public function getParentaddress()
    {
        return $this->parentaddress;
    }

    /**
     * Set parentphone
     *
     * @param string $parentphone
     *
     * @return Studentparent
     */
    public function setParentphone($parentphone)
    {
        $this->parentphone = $parentphone;

        return $this;
    }

    /**
     * Get parentphone
     *
     * @return string
     */
    public function getParentphone()
    {
        return $this->parentphone;
    }

    /**
     * Set parentemail
     *
     * @param string $parentemail
     *
     * @return Studentparent
     */
    public function setParentemail($parentemail)
    {
        $this->parentemail = $parentemail;

        return $this;
    }

    /**
     * Get parentemail
     *
     * @return string
     */
    public function getParentemail()
    {
        return $this->parentemail;
    }

    /**
     * Get idstudentparent
     *
     * @return integer
     */
    public function getIdstudentparent()
    {
        return $this->idstudentparent;
    }

    /**
     * Set idstudent
     *
     * @param \AppBundle\Entity\Student $idstudent
     *
     * @return Studentparent
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
}
