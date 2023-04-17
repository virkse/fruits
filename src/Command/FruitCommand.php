<?php

namespace App\Command;

use App\Entity\Fruit;
use App\Entity\Fruits;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


// the name of the command is what users type after "php bin/console"

#[AsCommand(name: 'fruits:fetch')]
class FruitCommand extends Command
{
    public $entityManager;
    public $mailer;

    public function __construct(
        private HttpClientInterface $client,
        EntityManagerInterface $entityManager,
    ) {
        parent::__construct();

        $this->entityManager = $entityManager;
    }

    protected static $defaultDescription = 'Fetch fruites.';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        

        $fruits = $this->fetchFruits();

        $output->writeln('Whoa!');
        return 1;
    }

    /**
     * fetchFruits
     * 
     * @param void
     * @return array
     */
    private function fetchFruits(): array
    {
        //$entityManager = $this->container->get('doctrine')->getManager();

        $response = $this->client->request(
            'GET',
            'https://fruityvice.com/api/fruit/all'
        );

        $fruits = $response->toArray();

        foreach($fruits as $fruit) {
            
            $entity = $this->entityManager->getRepository(Fruits::class)->findOneBy([
                'name' => $fruit['name']
            ]);

            if(!$entity) {
                $entity = new Fruits();
            }

            $entity->setGenus($fruit['genus']);
            $entity->setName($fruit['name']);
            $entity->setFamily($fruit['family']);
            $entity->setFOrder($fruit['order']);

            $entity->setFruitId($fruit['id']);
            $entity->setCarbohydrates($fruit['nutritions']['carbohydrates']);
            $entity->setProtein($fruit['nutritions']['protein']);
            $entity->setFat($fruit['nutritions']['fat']);
            $entity->setCalories($fruit['nutritions']['calories']);
            $entity->setSugar($fruit['nutritions']['sugar']);

            $this->entityManager->persist($entity);
            $this->entityManager->flush();
           
        }

        ## after fetch send an email, But, i don't have mailer credentials you can think email is sent

        /*$email = (new Email())
            ->from('mrverak@gmail.com')
            ->to('mrverak@gmail.com')
            ->subject('Fruits notification!')
            ->text('Fruits notification!')
            ->html('<p>Fruits are saved to database</p>!</p>');

        $this->mailer->send($email);*/

        return $fruits;
    }
}
