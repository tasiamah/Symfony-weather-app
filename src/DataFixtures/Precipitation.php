<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Precipitation extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
    
		if (($handle = fopen(dirname(dirname(__DIR__)).'/public/data/time-series.csv', "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
				
				$station1 = $manager->getRepository('App:Stations')->findOneBy([
					'name' => 'Berne - Zollikofen'
				]);
				$station2 = $manager->getRepository('App:Stations')->findOneBy([
					'name' => 'Pully'
				]);
				$station3 = $manager->getRepository('App:Stations')->findOneBy([
					'name' => 'ZUERICH/FLUNTERN'
				]);
				
				//station 1 Precipitation
				$p = new \App\Entity\Precipitation();
				$p->setValue($data[1])
					->setDate($data[0])
					->setStation($station1);
				$manager->persist($p);
				
				//Station 2 Precipitation
				$p = new \App\Entity\Precipitation();
				$p->setValue($data[2])
					->setDate($data[0])
					->setStation($station2);
				$manager->persist($p);
				
//				Station 3 Precipitation
				$p = new \App\Entity\Precipitation();
				$p->setValue($data[3])
					->setDate($data[0])
					->setStation($station3);
				$manager->persist($p);
				
				//Station 1 Temperature
				$t = new \App\Entity\Temperature();
				$t->setStation($station1)
					->setDate($data[0])
					->setValue($data[4]);
				$manager->persist($t);
				
				//Station 2 Temperature
				$t = new \App\Entity\Temperature();
				$t->setStation($station2)
					->setDate($data[0])
					->setValue($data[5]);
				$manager->persist($t);
				
				//Station 3 Temperature
				$t = new \App\Entity\Temperature();
				$t->setStation($station3)
					->setDate($data[0])
					->setValue($data[6]);
				$manager->persist($t);
			}
			fclose($handle);
		}
        $manager->flush();
    }
	
	public function getDependencies()
	{
		return [
			Stations::class
		];
	}
}
