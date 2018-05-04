<?php
namespace TestBundle\MessageManager\Factory;
use TestBundle\MessageManager\Service\MessageGenerator;

class MessageFactory
{
    public function __construct($adminEmail) {
        echo $adminEmail;die;

    }

    public static function createMessage($class)
    {
        echo $class;die;

        $MessageGenerator = new $class();
        return $newsletterManager;
    }
}
