<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client; 

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getFranceData():array
    {
        return $this->getApi('france');
        
    }

    public function getRegionData():array
    {
        return $this->getApi('departements');
    }

    public function getDepartementData($department):array
    {
        
        return $this->getApi('departements?Departement='.$department);
    }

    public function getAllDataByDate($date)
    {
        $response = $this->client->request(
            'GET',
            'https://coronavirusapifr.herokuapp.com/data/departements-by-date/'.$date 
        );

        return $response->toArray();
    }

    public function getKey($department)
    {
        
        $data = $this->getApi('departements?Departement='.$department);

        $keys = array_keys($data);
        for($i = 0; $i < count($data); $i++) {
         foreach($data[$keys[$i]] as $key => $value) {
        
            if($value == $department)
                {
                return $i;
                continue;
                }
            }
        }
            
    }

    private function getApi($var)
    {
        $response = $this->client->request(
            'GET',
            'https://coronavirusapifr.herokuapp.com/data/live/'.$var 
        );
       
        return $response->toArray();
    }

}
