<?php


namespace App\Entity\Software;


use App\Entity\AbstractPrimaryEntity;
use App\Entity\Company\Company;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Software\SoftwareRepository;

/**
 * Class Software
 * @ORM\MappedSuperclass(repositoryClass=SoftwareRepository::class)
 * @package App\Entity\Software
 */
abstract class Software extends AbstractPrimaryEntity
{
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $name;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class)
     * @var Company
     */
    private Company $maker;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Company
     */
    public function getMaker(): Company
    {
        return $this->maker;
    }

    /**
     * @param Company $maker
     */
    public function setMaker(Company $maker): void
    {
        $this->maker = $maker;
    }

}
