<?php

namespace Acme\HelloBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="medico")
 */
class Medico 
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
     * @ORM\Column(type="integer")
     */
    protected $numColegiado;

	/**
     * @ORM\ManyToMany(targetEntity="Especialidad", inversedBy="medicos")
	 * @ORM\JoinTable(name="medico_especialidad")
     */
    private $especialidad;


    public function __construct()
	{
		$this->especialidades = new ArrayCollection();
	}
	
	public function addEspecialidad(Especialidad $especialidad)
	{
		
		$this->especialidades[] = $especialidad;
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
     * @return Medico
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
     * Set numColegiado
     *
     * @param integer $numColegiado
     * @return Medico
     */
    public function setNumColegiado($numColegiado)
    {
        $this->numColegiado = $numColegiado;

        return $this;
    }

    /**
     * Get numColegiado
     *
     * @return integer 
     */
    public function getNumColegiado()
    {
        return $this->numColegiado;
    }

    /**
     * Remove especialidad
     *
     * @param \Acme\HelloBundle\Entity\Especialidad $especialidad
     */
    public function removeEspecialidad(\Acme\HelloBundle\Entity\Especialidad $especialidad)
    {
        $this->especialidad->removeElement($especialidad);
    }

    /**
     * Get especialidad
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }
}
