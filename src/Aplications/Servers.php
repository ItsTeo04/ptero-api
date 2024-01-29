<?php

namespace Gigabait\PteroApi\Aplications;

use Gigabait\PteroApi\PteroApi;

class Servers extends PteroApi
{
    private $endpoint;
    protected $ptero;
    public function __construct(PteroApi $ptero)
    {
        $this->ptero = $ptero;
        $this->endpoint = $ptero->api_type . '/servers';
    }

    /**
     * Summary of pagination
     * @param mixed $page
     * @return mixed
     */
    public function pagination($page)
    {
        return $this->ptero->makeRequest('GET', $this->endpoint, ['page' => $page]);
    }

    /**
     * Summary of all
     * @return mixed
     */
    public function all()
    {
        return $this->ptero->makeRequest('GET', $this->endpoint . '?include=egg,nest,allocations,user,node,location');
    }

    /**
     * Summary of get
     * @param int $id
     * @return mixed
     */
    public function get(int $id)
    {
        return $this->ptero->makeRequest('GET', $this->endpoint . '/' . $id . '?include=egg,nest,allocations,user,node,location');
    }

    /**
     * Summary of get
     * @param string $uuid
     * @return mixed
     */
    public function getUuid(string $uuid)
    {
        $servers = $this->all();
        foreach ($servers['data'] as $server) {
            if ($server['attributes']['uuid'] === $uuid) {
                return $server;
            }
        }

        return "Server with UUID {$uuid} not found";
    }

    // public function getUuid(string $uuid)
    // {
    //     $servers = $this->all();
    //     foreach ($servers['data'] as $server) {
    //         if ($server['attributes']['uuid'] === $uuid) {
    //             return $this->get($server['attributes']['id']);
    //         }
    //     }

    //     return "Server with UUID {$uuid} not found";
    // }

    /**
     * Summary of getExternal
     * @param string $id
     * @return mixed
     */
    public function getExternal(string $id)
    {
        return $this->ptero->makeRequest('GET', $this->endpoint . '/external/' . $id . '?include=egg,nest,allocations,user,node,location');
    }

    /**
     * Summary of update
     * @param int $id
     * @param array $params
     * @return mixed
     * $params = [
     * "name" => "Gaming",
     * "user" => 1,
     * "external_id" => "RemoteID1",
     * "description" => "Matt from Wii Sports"
     * ]
     */
    public function update(int $id, array $params)
    {
        return $this->ptero->makeRequest('PATCH', $this->endpoint . '/' . $id . '/details', $params);
    }

    /**
     * Summary of update
     * @param int $id
     * @param array $params
     * @return mixed
     * $params = [
     * "allocation" => 1,
     * "swap" => 0,
     * "disk" => 200,
     * "io" => 500,
     * "cpu" => 0,
     * "threads" => null,
     * "feature_limits" => [
     *    "databases" => 5,
     *    "allocations" => 5,
     *    "backups" => 2
     *    ]
     * ]
     */
    public function build(int $id, array $params)
    {
        return $this->ptero->makeRequest('PATCH', $this->endpoint . '/' . $id . '/build', $params);
    }

    /**
     * Summary of update
     * @param int $id
     * @param array $params
     * @return mixed
     * $params = [
     * "startup" => "java -Xms128M -Xmx{{SERVER_MEMORY}}M -jar {{SERVER_JARFILE}}",
     * "environment" => [
     *    "SERVER_JARFILE" => "server.jar",
     *    "VANILLA_VERSION" => "latest"
     *    ],
     * "egg" => 5,
     * "image" => "quay.io/pterodactyl/core:java",
     * "skip_scripts" => false
     * ]
     */
    public function startup(int $id, array $params)
    {
        return $this->ptero->makeRequest('PATCH', $this->endpoint . '/' . $id . '/startup', $params);
    }

    /**
     * Summary of create
     * @param array $params
     * @return mixed
     * $params = [
     * "name" => "Building",
     * "user" => 1,
     * "egg" => 1,
     * "docker_image" => "quay.io/pterodactyl/core:java",
     * "startup" => "java -Xms128M -Xmx128M -jar server.jar",
     * "environment" => [
     *    "BUNGEE_VERSION" => "latest",
     *    "SERVER_JARFILE" => "server.jar"
     *    ],
     * "limits" => [
     *    "memory" => 128,
     *    "swap" => 0,
     *    "disk" => 512,
     *    "io" => 500,
     *    "cpu" => 100
     *    ],
     * "feature_limits" => [
     *    "databases" => 5,
     *    "backups" => 1
     *    ],
     * "allocation" => ["default" => 17],
     * ];
     */
    public function create(array $params)
    {
        return $this->ptero->makeRequest('POST', $this->endpoint. '?include=egg,nest,allocations,user,node,location', $params);
    }

    /**
     * Summary of suspend
     * @param int $id
     * @return mixed
     */
    public function suspend(int $id)
    {
        return $this->ptero->makeRequest('POST', $this->endpoint . '/' . $id . '/suspend');
    }

    /**
     * Summary of unsuspend
     * @param int $id
     * @return mixed
     */
    public function unsuspend(int $id)
    {
        return $this->ptero->makeRequest('POST', $this->endpoint . '/' . $id . '/unsuspend');
    }

    /**
     * Summary of reinstall
     * @param int $id
     * @return mixed
     */
    public function reinstall(int $id)
    {
        return $this->ptero->makeRequest('POST', $this->endpoint . '/' . $id . '/reinstall');
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

    /**
     * Summary of forceDelete
     * @param int $id
     * @return mixed
     */
    public function forceDelete(int $id)
    {
        return $this->ptero->makeRequest('DELETE', $this->endpoint . '/' . $id . '/force');
    }
}
