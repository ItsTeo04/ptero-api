<?php

namespace Gigabait\PteroApi\Aplications;

use Gigabait\PteroApi\PteroApi;

class Eggs extends PteroApi
{
    private $endpoint;
    protected $ptero;
    public function __construct(PteroApi $ptero)
    {
        $this->ptero = $ptero;
        $this->endpoint = $ptero->api_type . '/nests';
    }

    /**
     * Summary of all
     * @param int $nest_id
     * @return mixed
     */
    public function all(int $nest_id)
    {
        return $this->ptero->makeRequest('GET', $this->endpoint . '/' . $nest_id . '/eggs?include=nest,servers,variables');
    }

    /**
     * Summary of get
     * @param int $nest_id
     * @param int $egg_id
     * @return mixed
     */
    public function get(int $nest_id, int $egg_id)
    {
        return $this->ptero->makeRequest('GET', $this->endpoint . '/' . $nest_id . '/eggs/' . $egg_id . '?include=nest,servers,variables');
    }
}
