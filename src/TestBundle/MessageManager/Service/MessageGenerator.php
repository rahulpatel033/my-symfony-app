<?php
namespace TestBundle\MessageManager\Service;
use Psr\Log\LoggerInterface;
use TestBundle\Entity\User;

// use Doctrine\ORM\EntityManagerInterface;


class MessageGenerator
{
    private $logger;
    private $adminEmail;
    private $doctrine;

    public function __construct(LoggerInterface $logger, $adminEmail, $doctrine)
    {
        $this->logger = $logger;
        $this->adminEmail = $adminEmail;
        $this->doctrine = $doctrine;
    }

    public function getHappyMessage()
    {

        // $entityManager = $this->doctrine->getManager();

        // $product = new User();
        // $product->setName('Keyboard');
        // $product->setDescription('Ergonomic and stylish!');

        // $this->doctrine->persist($product);
        
        // $this->doctrine->flush();
        
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index].$this->adminEmail.$product->getId();
    }
}