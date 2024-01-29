<?php

namespace Gigabait\PteroApi\Client\Server;

use Gigabait\PteroApi\PteroApi;

class Network extends PteroApi
{
    private $endpoint;
    protected $ptero;
    public function __construct(PteroApi $ptero)
    {
        $this->ptero = $ptero;
        $this->endpoint = $ptero->api_type . '/servers';
    }

    /**
     * Summary of get
     * @param string $uuidShort
     * @return mixed
     */
    public function get(string $uuidShort)
    {
        return $this->ptero->makeRequest('GET', $this->endpoint . '/' . $uuidShort . '/network/allocations');
    }

    /**
     * Summary of set
     * @param string $uuidShort
     * @param int $allocation_id
     * @return mixed
     */
    public function set(string $uuidShort, int $allocation_id)
    {
        return $this->ptero->makeRequest('POST', $this->endpoint . '/' . $uuidShort . '/network/allocations/' . $allocation_id);
    }

    /**
     * Summary of setNotes
     * @param string $uuidShort
     * @param int $allocation_id
     * @param string $notes
     * @return mixed
     */
    public function setNotes(string $uuidShort, int $allocation_id, string $notes)
    {
        return $this->ptero->makeRequest('POST', $this->endpoint . '/' . $uuidShort . '/network/allocations/' . $allocation_id, ['notes' => $notes]);
    }

    /**
     * Summary of setPrimary
     * @param string $uuidShort
     * @param int $allocation_id
     * @return mixed
     */
    public function setPrimary(string $uuidShort, int $allocation_id)
    {
        return $this->ptero->makeRequest('POST', $this->endpoint . '/' . $uuidShort . '/network/allocations/' . $allocation_id . '/primary');
    }

    /**
     * Summary of delete
     * @param string $uuidShort
     * @param int $allocation_id
     * @return mixed
     */
    public function delete(string $uuidShort, int $allocation_id)
    {
        return $this->ptero->makeRequest('DELETE', $this->endpoint . '/' . $uuidShort . '/network/allocations/' . $allocation_id);
    }
}
