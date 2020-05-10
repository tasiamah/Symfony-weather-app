<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Stations extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$stations = [
    		'Berne - Zollikofen' => [46.98, 7.47],
			'Pully' => [46.51, 6.67],
			'ZUERICH/FLUNTERN' => [47.3831, 8.5667]
		];
    	
    	$codes = [
			'Berne - Zollikofen' => 'CH-BE',
			'Pully' => 'CHE',
			'ZUERICH/FLUNTERN' => 'CH-ZH'
		];
    	
    	foreach($stations as $name => $latlong){
    		$s = new \App\Entity\Stations();
    		$s->setName($name)
				->setLatitude($latlong[0])
				->setLongitude($latlong[1])
				->setCode($codes[$name])
			;
    		$manager->persist($s);
		}

        $manager->flush();
    }
}
