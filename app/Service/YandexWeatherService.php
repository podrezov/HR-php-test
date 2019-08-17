<?php namespace App\Service;

use GuzzleHttp\Client;

class YandexWeatherService
{
    const URL = 'https://api.weather.yandex.ru/v1/informers';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param float $lat
     * @param float $lon
     *
     * @return array
     */
    public function getWeather(float $lat = 53.2520900, float $lon = 34.3716700)
    {
        $res = $this->client->get(self::URL, [
            'query' => [
                'lat' => $lat,
                'lon' => $lon,
            ],
            'headers' => [
                'X-Yandex-API-Key' => env('YANDEX_API_KEY')
            ]
        ]);

        return json_decode($res->getBody(), true);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getFactWeather()
    {
        $weather = $this->getWeather();

        if (!isset($weather['fact'])) {
            throw new \Exception('No actual weather found');
        }

        return $weather['fact'];
    }
}
