<?php

namespace Gigabait\PteroApi\Aplications;

use Gigabait\PteroApi\PteroApi;

class Node extends PteroApi
{
    private $endpoint;
    protected $ptero;
    public function __construct(PteroApi $ptero)
    {
        $this->ptero = $ptero;
        $this->endpoint = $ptero->api_type . '/nodes';
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
     * Summary of config
     * @param int $id
     * @return mixed
     */
    public function config(int $id)
    {
        return $this->ptero->makeRequest('GET', $this->endpoint . '/' . $id . '/configuration');
    }

    /**
     * Summary of create
     * @param array $params
     * @return mixed
     * $params = [
     * "name" => "New Node",
     * "location_id" => 1,
     * "fqdn" => "node2.example.com",
     * "scheme" => "https",
     * "memory" => 10240,
     * "memory_overallocate" => 0,
     * "disk" => 50000,
     * "disk_overallocate" => 0,
     * "upload_size" => 100,
     * "daemon_sftp" => 2022,
     * "daemon_listen" => 8080
     * ]
     */
    public function create(array $params)
    {
        return $this->ptero->makeRequest('POST', $this->endpoint, $params);
    }

    /**
     * Summary of update
     * @param int $id
     * @param array $params
     * @return mixed
     * * $params = [
     * "name" => "New Node",
     * "description" => "Test",
     * "location_id" => 1,
     * "fqdn" => "node2.example.com",
     * "scheme" => "https",
     * "behind_proxy" => false,
     * "maintenance_mode" => false,
     * "memory" => 10240,
     * "memory_overallocate" => 0,
     * "disk" => 50000,
     * "disk_overallocate" => 0,
     * "upload_size" => 100,
     * "daemon_sftp" => 2022,
     * "daemon_listen" => 8080
     * ]
     */
    public function update(int $id, array $params)
    {
        return $this->ptero->makeRequest('PATCH', $this->endpoint . '/' . $id, $params);
    }

    public function delete(int $id)
    {
        return $this->ptero->makeRequest('DELETE', $this->endpoint . '/' . $id);
    }
}
