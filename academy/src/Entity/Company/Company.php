<?php

namespace App\Entity;

namespace App\Entity\Company;

use App\Entity\AbstractPrimaryEntity;
use App\Entity\Country\Country;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Company
 * @ORM\Entity(repositoryClass="App\Repository\Company\CompanyRepository")
 * @package App\Entity\Company
 */
class Company extends AbstractPrimaryEntity
{
    /**
     * @ORM\Column(type="string")
     * @Groups({"common", "company_full"})
     * @var string
     */
    protected string $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups("company_full")
     * @var \DateTime|null
     */
    protected ?\DateTime $founded = null;

    //TODO add country

    public function __construct()
    {
        //TODO add country construction
    }

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
     * @return \DateTime|null
     */
    public function getFounded(): ?\DateTime
    {
        return $this->founded;
    }

    /**
     * @param \DateTime|null $founded
     */
    public function setFounded(?\DateTime $founded): void
    {
        $this->founded = $founded;
    }

    /**
     * @Groups({"common"})
     * @return int|null\
     */
    public function getFoundedTimestamp(): ?int
    {
        return $this->founded ? $this->founded->getTimestamp() : null;
    }
}