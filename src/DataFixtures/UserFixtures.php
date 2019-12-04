<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct( UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for( $i= 0; $i < 10; $i++ )
        {
            $user = new User();
            $user->setEmail( $faker->safeEmail);
            $user->setPassword( $this->passwordEncoder->encodePassword( $user, '123456' ) );
            $user->setRoles(['USER']);
            $manager->persist( $user );
            $manager->flush();
        }
    }
}
