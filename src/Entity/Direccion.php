<?php

namespace App\Entity;

use App\Repository\DireccionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DireccionRepository::class)
 */
class Direccion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $calle;

    /**
     * @return mixed
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * @param mixed $calle
     */
    public function setCalle($calle): void
    {
        $this->calle = $calle;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $puertaPisoEscalera;

    /**
     * @ORM\Column(type="integer")
     */
    private $codPostal;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="direcciones")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity=Municipios::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $municipio;

    /**
     * @ORM\ManyToOne(targetEntity=Provincias::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $provincia;



    public function getId(): ?int
    {
        return $this->id;
    }



    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPuertaPisoEscalera(): ?string
    {
        return $this->puertaPisoEscalera;
    }

    public function setPuertaPisoEscalera(?string $puertaPisoEscalera): self
    {
        $this->puertaPisoEscalera = $puertaPisoEscalera;

        return $this;
    }

    public function getCodPostal(): ?int
    {
        return $this->codPostal;
    }

    public function setCodPostal(int $codPostal): self
    {
        $this->codPostal = $codPostal;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getMunicipio(): ?Municipios
    {
        return $this->municipio;
    }

    public function setMunicipio(Municipios $municipio): self
    {
        $this->municipio = $municipio;

        return $this;
    }

    public function getProvincia(): ?Provincias
    {
        return $this->provincia;
    }

    public function setProvincia(Provincias $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }


}
