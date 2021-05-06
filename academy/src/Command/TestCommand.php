<?php


namespace App\Command;


use App\Entity\Company\Company;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\VarDumper\VarDumper;

class TestCommand extends Command
{

    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct('test');
        $this->entityManager = $entityManager;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

//        VarDumper::dump($this->entityManager->getRepository(Company::class)->findAll());
//
//        die;
        $this->createCompanyWithUniqueNameOrGiveUp('Apple');
        $this->createCompanyWithUniqueNameOrGiveUp('Apple', new \DateTime('2021-01-01'));
        $this->createCompanyWithUniqueNameOrGiveUp('Apple Blockchain Inc.', new \DateTime('2021-01-01'));

        return 0;
    }

    private function createCompanyWithUniqueNameOrGiveUp(string $name, ?\DateTime $founded = null): void
    {
        $company = $this->entityManager->getRepository(Company::class)->findOneBy(['name' => $name]);
        if ($company) {
            return;
        }
        $company = new Company();
        $company->setName($name);
        $company->setFounded($founded);
        $this->entityManager->persist($company);
        $this->entityManager->flush();
    }

}