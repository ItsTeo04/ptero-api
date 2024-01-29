<?php

namespace Gigabait\PteroApi\Aplications;

use Gigabait\PteroApi\PteroApi;

class Users extends PteroApi
{
    private $endpoint;
    protected $ptero;
    public function __construct(PteroApi $ptero)
    {
        $this->ptero = $ptero;
        $this->endpoint = $ptero->api_type . '/users';
    }

    /**
     * Summary of all
     * @return mixed
     */
    public function all(string $filters = NULL)
    {
        return $this->ptero->makeRequest('GET', $this->endpoint . $filters);
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
     * Summary of getExternal
     * @param string $id
     * @return mixed
     */
    public function getExternal(string $id)
    {
        return $this->ptero->makeRequest('GET', $this->endpoint . '/external/' . $id);
    }

    /**
     * Summary of create
     * @param array $params
     * @return mixed
     * $params = [
     * "email" => "example10@gmail.com",
     * "username" => "exampleuser",
     * "first_name" => "Example",
     * "last_name" => "User"
     * ]
     */
    public function create(array $params)
    {
        return $this->ptero->makeRequest('POST', $this->endpoint, $params);
    }

    /**
     * Summary of update
     * @param array $params
     * @return mixed
     * $params = [
     * "email" => "example10@gmail.com",
     * "username" => "exampleuser",
     * "first_name" => "Example",
     * "last_name" => "User"
     * ]
     */
    public function update(int $user_id, array $params)
    {
        return $this->ptero->makeRequest('PATCH', $this->endpoint . '/' . $user_id, $params);
    }

    /**
     * Summary of delete
     * @param int $user_id
     * @return mixed
     */
    public function delete(int $user_id)
    {
        return $this->ptero->makeRequest('DELETE', $this->endpoint . '/' . $user_id);
    }
}
