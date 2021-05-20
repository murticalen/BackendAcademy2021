<?php


namespace App\Entity\Device;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Laptop
 * @ORM\Entity()
 * @package App\Entity\Device
 */
class Laptop extends Device
{

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $osName;

    public function getName(): string
    {
        return $this->getMaker()->getName() . ' ' . parent::getName();
    }

}
