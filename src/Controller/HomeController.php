<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CallApiService;


class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(CallApiService $callApiService): Response
    {
        //$date = new \DateTime();

        return $this->render('home/index.html.twig',[
            'data'=>$callApiService->getFranceData(),
            'departments'=>$callApiService->getRegionData(),
            //'all'=>$callApiService->getAllDataByDate('24-08-2022')        
        ]);
    }

}
