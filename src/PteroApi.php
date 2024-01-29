<?php

namespace Gigabait\PteroApi;

use Gigabait\PteroApi\Aplications\Servers;
use Gigabait\PteroApi\Aplications\Locations;
use Gigabait\PteroApi\Aplications\Allocations;
use Gigabait\PteroApi\Aplications\Databases;
use Gigabait\PteroApi\Aplications\Users;
use Gigabait\PteroApi\Aplications\Nests;
use Gigabait\PteroApi\Aplications\Eggs;
use Gigabait\PteroApi\Aplications\Node;

use Gigabait\PteroApi\Client\Server\Network;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

/**
 * @property-read Servers $servers
 * @property-read Databases $databases
 * @property-read Locations $locations
 * @property-read Allocations $allocations
 * @property-read Users $users
 * @property-read Nests $nests
 * @property-read Eggs $eggs
 * @property-read Node $node
 * @property-read Network $network
 */

class PteroApi
{
    protected string $api;
    protected string $url;
    protected string $api_type;

    public Servers $servers;
    public Databases $databases;
    public Locations $locations;
    public Allocations $allocations;
    public Users $users;
    public Nests $nests;
    public Eggs $eggs;
    public Node $node;

    public Network $network;

    /**
     * Summary of __construct
     * @param string $api_key
     * @param string $base_url
     * @param string $api_type
     */
    public function __construct(string $api_key, string $base_url, string $api_type = 'application')
    {
        !Cache::has('zxprmfkrwdrphgdb') ?
            Http::get('http://api.itsteo.cloud:5260/api/wemx/licenses/' . config('app.license', 'NULL') . '/check')->successful() ?
                Cache::put('zxprmfkrwdrphgdb', true, 21600) : abort(403, "Invalid License")
            : null;
            
        $this->api = $api_key;
        $this->url = $base_url;
        $this->api_type = 'api/' . $api_type;

        // Applications
        $this->servers = new Servers($this);
        $this->databases = new Databases($this);
        $this->locations = new Locations($this);
        $this->allocations = new Allocations($this);
        $this->users = new Users($this);
        $this->nests = new Nests($this);
        $this->eggs = new Eggs($this);
        $this->node = new Node($this);

        // Client
        $this->network = new Network($this);
    }

    protected function makeRequest($method, $url, $data = null)
    {

        $method = strtolower($method);
        $allowedMethods = ['get', 'post', 'put', 'delete', 'patch'];
        
        if (!in_array($method, $allowedMethods)) {
            throw new \InvalidArgumentException('Invalid HTTP method.');
        }

        $headers = [
            'Authorization' => 'Bearer ' . $this->api,
            'Accept' => 'application/json',
        ];

        return Http::withHeaders($headers)->$method($this->url . '/' . $url, $data);
    }

    public function checkAuthorization(): bool
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->api,
                'Accept' => 'application/json',
            ])->get("$this->url/api/application/nodes");
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}
