<?php
namespace Hanweizhe\Weather;

use GuzzleHttp\Client;
use Hanweizhe\Weather\Exceptions\InvalidArgumentException;
use Hanweizhe\Weather\Exceptions\HttpException;

class Weather
{
    protected $key;
    protected $guzzleOptions = [];
    public function __construct(string $key)
    {
        $this->key = $key;
    }
    
    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }
    public function getWeather($city,$type = 'base',$format = 'json')
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';
        if(!in_array(strtolower($format),['json','xml']))
        {
            throw new InvalidArgumentException('Invalid response format: '.$format);
        }
        if(!in_array(strtolower($type),['base','all']))
        {
            throw new InvalidArgumentException('Invalid response type: '.$type);            
        }
        $query = array_filter([
            'key' => $this->key,
            'city' => $city,
            'output' => $format,
            'extensions' => $type,
        ]);

        try{
            $reponse = $this->getHttpClient()->get($url,[
                'query' => $query,
            ])->getBody()->getContents();
    
            return 'json' == $format ? \json_decode($reponse,true) : $reponse;
        }catch(\Exception $e) {
            throw new HttpException($e->getMessage(),$e->getCode(),$e);
        }
    }
}