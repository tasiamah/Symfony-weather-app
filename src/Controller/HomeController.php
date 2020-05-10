<?php

namespace App\Controller;

use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }
	
	/**
	 * @Route("/regions", name="get_regions")
	 */
    public function getRegions(){
    	$em = $this->getDoctrine()->getManager();
    	
    	$regions = $em->createQueryBuilder();
    	$r = $regions->from('App:Stations', 's')
			->select('s')
			->getQuery();
    	
    	return $this->json([
    		'data' => $r->getArrayResult()
		]);
	}
	
	/**
	 * @Route("/chart-data", name="chart_data")
	 */
	public function chartData(Request $request){
		
		$em = $this->getDoctrine()->getManager();
		
		/**
		 * @var $query QueryBuilder
		 */
		$query = $em->createQueryBuilder();
		if(trim($request->query->get('year')) != ''){
			$query->andWhere('t.date LIKE :date')->setParameter('date', '%'.$request->query->get('year').'%');
		}
		$temperature = $query->from('App:Temperature', 't')
			->select('t')
			->andWhere('t.stationId = :id')
			->setParameter('id', $request->query->get('id'))
			->getQuery();
		
		/**
		 * @var $q QueryBuilder
		 */
		$p = $em->createQueryBuilder();
		if(trim($request->query->get('year')) != ''){
			$p->andWhere('p.date LIKE :date')->setParameter('date', '%'.$request->query->get('year').'%');
		}
		$precipitation = $p->from('App:Precipitation', 'p')
			->select('p')
			->andWhere('p.stationId = :id')
			->setParameter('id', $request->query->get('id'))
			->getQuery();
		
		return $this->json([
			'data' => [
				'temperature' => $temperature->getArrayResult(),
				'precipitation' => $precipitation->getArrayResult()
			]
		]);
	}
}
