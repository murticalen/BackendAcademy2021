<?php


namespace App\Entity\Software;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class OperatingSystem
 * @ORM\Entity()
 * @package App\Entity\Software
 */
class OperatingSystem extends Software
{
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $latestVersion;

    /**
     * @return string
     */
    public function getLatestVersion(): string
    {
        return $this->latestVersion;
    }

    /**
     * @param string $latestVersion
     */
    public function setLatestVersion(string $latestVersion): void
    {
        $this->latestVersion = $latestVersion;
    }

}
