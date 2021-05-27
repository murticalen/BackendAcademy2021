<?php


namespace App\Command;


use App\Service\Listener\CompanyChangeListener;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use SymfonyBundles\RedisBundle\Redis\ClientInterface;

class CompanyNameChangePushCommand extends Command
{

    protected ClientInterface $redis;

    public function __construct(ClientInterface $redis)
    {
        $this->redis = $redis;
        parent::__construct('push:company:name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        while (true) {
            $companyId = $this->redis->pop(CompanyChangeListener::COMPANY_NAME_CHANGE_QUEUE_ID);
            if ($companyId) {
                //SEND EMAIL ABOUT COMPANY NAME CHANGE
                var_dump($companyId);
            }
        }
    }

}
