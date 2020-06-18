<?php


namespace App\Service;


use Psr\Log\LoggerInterface;

class LuckyNumber
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        //przypisanie po lewej odwołuje się do prywatnej zmiennej
        $this->logger = $logger;
    }

    public function getLuckyNumber(): int
    {
        return $this->getPrivateLuckyNumber();
    }

    private function getPrivateLuckyNumber():int
    {
        $number = rand(1,100);
        $this->logger->debug($number);
        return $number;

    }
}