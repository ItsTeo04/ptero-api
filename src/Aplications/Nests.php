<?php

namespace Gigabait\PteroApi\Aplications;

use Gigabait\PteroApi\PteroApi;

class Nests extends PteroApi
{
    private $endpoint;
    protected $ptero;
    public function __construct(PteroApi $ptero)
    {
        $this->ptero = $ptero;
        $this->endpoint = $ptero->api_type . '/nests';
    }

    /**
     * Summary of pagination
     * @param int $page
     * @return mixed
     */
    public function pagination(int $page)
    {
        return $this->ptero->makeRequest('GET', $this->endpoint, ['page' => $page]);
    }

    /**
     * Summary of all
     * @param array|null $includes An associative array that may contain the following keys:
     *                             'eggs' => string,
     *                             'servers' => string,
     * @return mixed
     */
    public function all(array $includes = null): mixed
    {
        $includeString = $includes ? '?include=' . implode(',', $includes) : '';
        return $this->ptero->makeRequest('GET', $this->endpoint . $includeString);
    }

    /**
     * Summary of get
     * @param int $id
     * @return mixed
     */
    public function get(int $id)
    {
        return $this->ptero->makeRequest('GET', $this->endpoint . '/' . $id);
    }
}
