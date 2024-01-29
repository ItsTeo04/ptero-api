<?php

namespace Gigabait\PteroApi\Aplications;

use Gigabait\PteroApi\PteroApi;

class Locations extends PteroApi
{
    private $endpoint;
    protected $ptero;
    public function __construct(PteroApi $ptero)
    {
        $this->ptero = $ptero;
        $this->endpoint = $ptero->api_type . '/locations';
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
     * @return mixed
     */
    public function all()
    {
        return $this->ptero->makeRequest('GET', $this->endpoint);
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

    /**
     * Summary of create
     * @param string $short
     * @param string $long
     * @return mixed
     */
    public function create(string $short, string $long)
    {
        return $this->ptero->makeRequest('POST', $this->endpoint, ['short' => $short, 'long' => $long]);
    }

    /**
     * Summary of update
     * @param int $id
     * @param string $short
     * @param string $long
     * @return mixed
     */
    public function update(int $id, string $short, string $long)
    {
        return $this->ptero->makeRequest('PATCH', $this->endpoint . '/' . $id, ['short' => $short, 'long' => $long]);
    }

    /**
     * Summary of delete
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->ptero->makeRequest('DELETE', $this->endpoint . '/' . $id);
    }
}
