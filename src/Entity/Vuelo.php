<?php

namespace App\Entity;

use App\Repository\VueloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VueloRepository::class)
 */
class Vuelo
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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $aerolinea;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ciudadSalida;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ciudadLlegada;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaSalida;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaLlegada;

    /**
     * @ORM\OneToMany(targetEntity=Reserva::class, mappedBy="vuelo")
     */
    private $reservas;

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getAerolinea(): ?string
    {
        return $this->aerolinea;
    }

    public function setAerolinea(?string $aerolinea): self
    {
        $this->aerolinea = $aerolinea;

        return $this;
    }

    public function getCiudadSalida(): ?string
    {
        return $this->ciudadSalida;
    }

    public function setCiudadSalida(?string $ciudadSalida): self
    {
        $this->ciudadSalida = $ciudadSalida;

        return $this;
    }

    public function getCiudadLlegada(): ?string
    {
        return $this->ciudadLlegada;
    }

    public function setCiudadLlegada(string $ciudadLlegada): self
    {
        $this->ciudadLlegada = $ciudadLlegada;

        return $this;
    }

    public function getFechaSalida(): ?\DateTimeInterface
    {
        return $this->fechaSalida;
    }

    public function setFechaSalida(\DateTimeInterface $fechaSalida): self
    {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }

    public function getFechaLlegada(): ?\DateTimeInterface
    {
        return $this->fechaLlegada;
    }

    public function setFechaLlegada(\DateTimeInterface $fechaLlegada): self
    {
        $this->fechaLlegada = $fechaLlegada;

        return $this;
    }

    /**
     * @return Collection|Reserva[]
     */
    public function getReservas(): Collection
    {
        return $this->reservas;
    }

    public function addReserva(Reserva $reserva): self
    {
        if (!$this->reservas->contains($reserva)) {
            $this->reservas[] = $reserva;
            $reserva->setVuelo($this);
        }

        return $this;
    }

    public function removeReserva(Reserva $reserva): self
    {
        if ($this->reservas->removeElement($reserva)) {
            // set the owning side to null (unless already changed)
            if ($reserva->getVuelo() === $this) {
                $reserva->setVuelo(null);
            }
        }

        return $this;
    }
}
