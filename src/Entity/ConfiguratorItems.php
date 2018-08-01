<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConfiguratorItemsRepository")
 */
class ConfiguratorItems
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Profile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Colour;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Glass;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $GlassSpacerBar;
     
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Token; 
    
    public function __get($id)
    {
        return $this->Token[$id];
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getProfile(): ?string
    {
        return $this->Profile;
    }

    public function setProfile(string $Profile): self
    {
        $this->Profile = $Profile;

        return $this;
    }

    public function getColour(): ?string
    {
        return $this->Colour;
    }

    public function setColour(string $Colour): self
    {
        $this->Colour = $Colour;

        return $this;
    }

    public function getGlass(): ?string
    {
        return $this->Glass;
    }

    public function setGlass(string $Glass): self
    {
        $this->Glass = $Glass;

        return $this;
    }

    public function getGlassSpacerBar(): ?string
    {
        return $this->GlassSpacerBar;
    }

    public function setGlassSpacerBar(string $GlassSpacerBar): self
    {
        $this->GlassSpacerBar = $GlassSpacerBar;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->Token;
    }
}
