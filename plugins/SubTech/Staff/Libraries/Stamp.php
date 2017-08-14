<?php

namespace Plugins\SubTech\Staff\Libraries;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

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
     */
    public function __construct()
    {
        $this->guzzle = new Client();
    }


    /**
     * Get All Users
     */
    public function getUsers()
    {
        $uri = 'https://stamp.submissiontechnology.co.uk/api/v1/users/getAll?key=' . env('STAMP_API_KEY');

        $resp = $this->guzzle->get($uri);

        $users = $this->getResponse($resp)->users;

        return collect($users);
    }


    /**
     * Gets the actual response coz Guzzle is a bit obnoxious
     *
     * @param ResponseInterface $response
     * @return mixed
     */
    private function getResponse(ResponseInterface $response)
    {
        return json_decode($response->getBody()->getContents());
    }

}