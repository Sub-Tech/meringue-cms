<?php

use GuzzleHttp\Client;

/**
 * Class Stamp
 */
class Stamp
{

    /**
     * @var Client The Guzzle Client
     */
    private $guzzle;


    /**
     * Stamp constructor.
     * @param Client $guzzle
     */
    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }


    /**
     * Get All Users
     */
    public function getUsers()
    {
        $uri = 'https://submissiontechnology.co.uk/api/v1/users/getAll?key=' . env('STAMP_API_KEY');

        $resp = $this->guzzle->get($uri);

        return collect($resp->getBody()->getContents())->users;
    }

}