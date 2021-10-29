<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Student
 *
 * @ORM\Table(name="student", indexes={@ORM\Index(name="fk_student_schoolclass1_idx", columns={"idschoolclass"})})
 * @ORM\Entity
 */
class Student
{


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=45, nullable=false)
     */
    private $surname;


    /**
     * @var string
     * @Assert\Regex(pattern="/[kmKM]{1}/i",message="Błąd: Można wpisać tylko K lub M.")
     * @ORM\Column(name="gender", type="string", length=1, nullable=false)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=45, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postalcode", type="string", length=6, nullable=false)
     */
    private $postalcode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=45, nullable=false)
     */
    private $city;

    /**
     * @var string
     * @Assert\Regex(pattern="/[0-9]{11}/i",message="Błąd: Brak zgodności.")
     * @ORM\Column(name="pesel", type="string", length=45, nullable=false)
     */
    private $pesel;

    /**
     * @var string
     *
     * @ORM\Column(name="birthplace", type="string", length=45, nullable=false)
     */
    private $birthplace;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthDate", type="date", nullable=false)
     */
    private $birthdate;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="beginDate", type="date", nullable=false)
     */
    private $begindate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="date", nullable=false)
     */
    private $enddate;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=45, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="isActive", type="integer", nullable=true)
     */
    private $isactive;

    /**
     * @var string
     *
     * @ORM\Column(name="indivinfo", type="string", length=255, nullable=true)
     */
    private $indivinfo;

    /**
     * @var string
     *
     * @ORM\Column(name="achivinfo", type="string", length=255, nullable=true)
     */
    private $achivinfo;

    /**
     * @var integer
     *
     * @ORM\Column(name="idstudent", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idstudent;

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
     * Set name
     *
     * @param string $name
     *
     * @return Student
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
     * Set surname
     *
     * @param string $surname
     *
     * @return Student
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }


    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Student
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }


    /**
     * Set address
     *
     * @param string $address
     *
     * @return Student
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set postalcode
     *
     * @param string $postalcode
     *
     * @return Student
     */
    public function setPostalcode($postalcode)
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    /**
     * Get postalcode
     *
     * @return string
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Student
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set pesel
     *
     * @param string $pesel
     *
     * @return Student
     */
    public function setPesel($pesel)
    {
        $this->pesel = $pesel;

        return $this;
    }

    /**
     * Get pesel
     *
     * @return string
     */
    public function getPesel()
    {
        return $this->pesel;
    }

    /**
     * Get birthplace
     *
     * @return string
     */
    public function getBirthplace()
    {
        return $this->birthplace;
    }

    /**
     * Set birthplace
     *
     * @param string $birthplace
     *
     * @return Student
     */
    public function setBirthplace($birthplace)
    {
        $this->birthplace = $birthplace;
    }


    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set begindate
     *
     * @param \DateTime $birthdate
     *
     * @return Student
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }



    /**
     * Set begindate
     *
     * @param \DateTime $begindate
     *
     * @return Student
     */
    public function setBegindate($begindate)
    {
        $this->begindate = $begindate;

        return $this;
    }

    /**
     * Get begindate
     *
     * @return \DateTime
     */
    public function getBegindate()
    {
        return $this->begindate;
    }

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     *
     * @return Student
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate
     *
     * @return \DateTime
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Student
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Student
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isactive
     *
     * @param integer $isactive
     *
     * @return Student
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
     * Get indivinfo
     *
     * @return string
     */
    public function getIndivinfo()
    {
        return $this->indivinfo;
    }

    /**
     * Set indivinfo
     *
     * @param string $indivinfo
     *
     * @return Student
     */
    public function setIndivinfo($indivinfo)
    {
        $this->indivinfo = $indivinfo;
    }

    /**
     * Get achivinfo
     *
     * @return string
     */
    public function getAchivinfo()
    {
        return $this->achivinfo;
    }

    /**
     * Set achivinfo
     *
     * @param string $achivinfo
     *
     * @return Student
     */
    public function setAchivinfo($achivinfo)
    {
        $this->achivinfo = $achivinfo;
    }
    /**
     * Get idstudent
     *
     * @return integer
     */
    public function getIdstudent()
    {
        return $this->idstudent;
    }

    /**
     * Set idschoolclass
     *
     * @param \AppBundle\Entity\Schoolclass $idschoolclass
     *
     * @return Student
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



    public function  __toString()
    {
        // TODO: Implement __toString() method.
        return ($this->getSurname()." ".$this->getName());
    }
}
