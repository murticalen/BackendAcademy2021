<?php


namespace App\Entity\Device;

use App\Entity\AbstractPrimaryEntity;
use App\Entity\Company\Company;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\Device\DeviceRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Device
 * @ORM\Entity(repositoryClass=DeviceRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="dtype", type="string")
 * @ORM\DiscriminatorMap({
 *  "smartphone"=Smartphone::class,
 *  "laptop"=Laptop::class
 * })
 * @ORM\Table(name="device")
 * @package App\Entity\Device
 */
abstract class Device extends AbstractPrimaryEntity
{

    /**
     * @ORM\ManyToOne(targetEntity=Company::class)
     * @Groups("common")
     * @var Company
     */
    private Company $maker;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $modelId;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private string $name;

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

    /**
     * @return string
     */
    public function getModelId(): string
    {
        return $this->modelId;
    }

    /**
     * @param string $modelId
     */
    public function setModelId(string $modelId): void
    {
        $this->modelId = $modelId;
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

}
