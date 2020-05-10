<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Users extends Fixture
{
	private $encoder;
	public function __construct(UserPasswordEncoderInterface $encoder)
	{
		$this->encoder = $encoder;
	}
	
	public function load(ObjectManager $manager)
    {
        $user = new \App\Entity\Users();
        $user->setName('User')
			->setUsername('user')
			->setIsActive(true)
			->setSalt(uniqid())
			->setPassword($this->encoder->encodePassword($user, '12345'))
			->setCreatedAt(new \DateTime())
		;
        
        $manager->persist($user);
        $manager->flush();
    }
}
