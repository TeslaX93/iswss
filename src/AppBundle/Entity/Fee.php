<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fee
 *
 * @ORM\Table(name="fee", indexes={@ORM\Index(name="fk_fee_idstudent_idx", columns={"idstudent"})})
 * @ORM\Entity
 */
class Fee
{
    /**
     * @var string
     *
     * @ORM\Column(name="feename", type="string", length=45, nullable=false)
     */
    private $feename;

    /**
     * @var float
     *
     * @ORM\Column(name="feevalue", type="float", precision=10, scale=0, nullable=false)
     */
    private $feevalue;

    /**
     * @var integer
     *
     * @ORM\Column(name="idfee", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfee;

    /**
     * @var \AppBundle\Entity\Student
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Student")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idstudent", referencedColumnName="idstudent")
     * })
     */
    private $idstudent;
//    private $name;


    /**
     * Set feename
     *
     * @param string $feename
     *
     * @return Fee
     */
    public function setFeename($feename)
    {
        $this->feename = $feename;

        return $this;
    }

    /**
     * Get feename
     *
     * @return string
     */
    public function getFeename()
    {
        return $this->feename;
    }

    /**
     * Set feevalue
     *
     * @param float $feevalue
     *
     * @return Fee
     */
    public function setFeevalue($feevalue)
    {
        $this->feevalue = $feevalue;

        return $this;
    }

    /**
     * Get feevalue
     *
     * @return float
     */
    public function getFeevalue()
    {
        return $this->feevalue;
    }

    /**
     * Get idfee
     *
     * @return integer
     */
    public function getIdfee()
    {
        return $this->idfee;
    }

    /**
     * Set idstudent
     *
     * @param \AppBundle\Entity\Student $idstudent
     *
     * @return Fee
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
        return $this->getFeename();
    }

}
