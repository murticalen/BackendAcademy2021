<?php


namespace App\Command;


use App\Entity\Company\Company;
use App\Entity\Device\Device;
use App\Entity\Device\Laptop;
use App\Entity\Device\Smartphone;
use App\Service\Listener\CompanyChangeListener;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use SymfonyBundles\RedisBundle\Redis\ClientInterface;

class TestCommand extends Command
{

    protected EntityManagerInterface $entityManager;
    protected ClientInterface $client;
    protected ContainerInterface $container;

    private array $companyCache = [];

    public function __construct(EntityManagerInterface $entityManager, ClientInterface $client, CompanyChangeListener $listener, ContainerInterface $container)
    {
        parent::__construct('test');
        $this->entityManager = $entityManager;
        $this->client        = $client;
        $this->container  = $container;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $company = $this->entityManager->getRepository(Company::class)->find(1);

//        var_dump($company->getFounded());
//
//        $company->setFounded(\DateTime::createFromFormat('U', random_int(0, 9999999)));
        $company->setName(random_int(0, 128));

        $this->entityManager->flush();

        die;
        $this->client->push('aaa', 5);

        var_dump($this->client->pop('aaa'));

        die;
        $devices = $this->entityManager->getRepository(Device::class)->findAll();
        /** @var Device $device */
        foreach ($devices as $device) {
            var_dump($device->getName());
        }

        die;
        $apple = $this->createCompanyWithUniqueNameOrGiveUp('Apple');
        $iphone = new Smartphone();
        $iphone->setMaker($apple);
        $iphone->setModelId('5s2');
        $iphone->setName('Pro Max 12');
        $this->entityManager->persist($iphone);
        $mac = new Laptop();
        $mac->setMaker($apple);
        $mac->setModelId('h2s');
        $mac->setName('MacBook Pro (15-inch, 2017)');
        $this->entityManager->persist($mac);

        $this->entityManager->flush();

        die;
        $this->createCompanyWithUniqueNameOrGiveUp('Apple');
        $this->createCompanyWithUniqueNameOrGiveUp('Apple', new \DateTime('2021-01-01'));
        $this->createCompanyWithUniqueNameOrGiveUp('Apple Blockchain Inc.', new \DateTime('2021-01-01'));

        return 0;
    }

    private function yourOwnDoctrineCache(int $id): Company
    {
        if (isset($this->companyCache[$id])) {
            return $this->companyCache[$id];
        }
        /** @var Company|null $company */
        $company = $this->entityManager->getRepository(Company::class)->find($id);
        if ($company) {
            $this->companyCache[$id] = $company;
            return $company;
        }
    }

    private function createCompanyWithUniqueNameOrGiveUp(string $name, ?\DateTime $founded = null): Company
    {
        /** @var Company|null $company */
        $company = $this->entityManager->getRepository(Company::class)->findOneBy(['name' => $name]);
        if ($company) {
            return $company;
        }
        $company = new Company();
        $company->setName($name);
        $company->setFounded($founded);
        $this->entityManager->persist($company);
        $this->entityManager->flush();

        return $company;
    }

}
