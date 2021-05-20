<?php


namespace App\Entity\Software;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Game
 * @ORM\Entity()
 * @package App\Entity\Software
 */
class Game extends Software
{
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private int $priceUSD;

    /**
     * @ORM\ManyToMany(targetEntity=OperatingSystem::class)
     * @var Collection<OperatingSystem>
     */
    private Collection $supportedOperatingSystems;

    public function __construct()
    {
        $this->supportedOperatingSystems = new ArrayCollection(); //ALWAYS INITIALIZE COLLECTIONS IN CONSTRUCTOR
    }

    /**
     * @return int
     */
    public function getPriceUSD(): int
    {
        return $this->priceUSD;
    }

    /**
     * @param int $priceUSD
     */
    public function setPriceUSD(int $priceUSD): void
    {
        $this->priceUSD = $priceUSD;
    }

    /**
     * @return Collection<OperatingSystem>
     */
    public function getSupportedOperatingSystems(): Collection
    {
        return $this->supportedOperatingSystems;
    }

    /**
     * @param Collection<OperatingSystem> $supportedOperatingSystems
     */
    public function setSupportedOperatingSystems(Collection $supportedOperatingSystems): void
    {
        $this->supportedOperatingSystems = $supportedOperatingSystems;
    }

}
