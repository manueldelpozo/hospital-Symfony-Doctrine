<?php

namespace Acme\HelloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="especialidad")
 */
class Especialidad 
{
    /**
     * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

	/**
     * @ORM\ManyToMany(targetEntity="Medico", mappedBy="especialidades")
     */
    private $medicos;
	
	public function __construct()
	{
		$this->medicos = new ArrayCollection();
	}
	
	public function addMedico(Medico $medico)
	{
		$medico->addEspecialidad($this); //synchronously updating inverse side
		$this->medicos[] = $medico;
	}


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Especialidad
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
     * Remove medicos
     *
     * @param \Acme\HelloBundle\Entity\Medico $medicos
     */
    public function removeMedico(\Acme\HelloBundle\Entity\Medico $medicos)
    {
        $this->medicos->removeElement($medicos);
    }

    /**
     * Get medicos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedicos()
    {
        return $this->medicos;
    }
	
	public function __toString() {
		return $this->name;
	}
}
