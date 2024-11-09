<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SAPService
{
    protected $baseUrl;
    protected $sessionId;
    protected $defaultHeaders;

    public function __construct()
    {
        $this->baseUrl = env('SAP_B1_URL');
        $this->authenticate();
        $this->initializeDefaultHeaders();
    }

    protected function initializeDefaultHeaders()
    {
        $this->defaultHeaders = [
            'Cookie' => "B1SESSION={$this->sessionId}",
            'Content-Type' => 'application/json',
            'Prefer' => 'return=representation'
        ];
    }

    protected function authenticate()
    {
        try {
            $response = Http::withOptions([
                'verify' => false
            ])->withHeaders([
                'Content-Type' => 'application/json'
            ])->post($this->baseUrl . 'Login', [
                'UserName' => env('SAP_B1_USERNAME'),
                'Password' => env('SAP_B1_PASSWORD'),
                'CompanyDB' => env('SAP_B1_DATABASE')
            ]);

            if (!$response->successful()) {
                throw new \Exception("Authentication failed: " . $response->body());
            }

            $this->sessionId = $response['SessionId'];
        } catch (\Exception $e) {
            Log::error("SAP B1 Authentication error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get data with pagination support
     * 
     * @param string $endpoint API endpoint
     * @param array $parameters Query parameters
     * @param int $pageSize Number of records per page
     * @param bool $fetchAll Whether to fetch all data at once
     * @return array
     */
    public function get($endpoint, $parameters = [], $pageSize = 20, $fetchAll = false)
    {
        try {
            // Tambahkan parameter untuk pagination jika belum ada
            if (!isset($parameters['$skip'])) {
                $parameters['$skip'] = 0;
            }

            // Set header dengan page size yang diinginkan
            $headers = [
                'Cookie' => "B1SESSION={$this->sessionId}",
                'Content-Type' => 'application/json',
                'Prefer' => "odata.maxpagesize={$pageSize}"
            ];

            // Jika fetchAll=true, ambil semua data
            if ($fetchAll) {
                return $this->fetchAllData($endpoint, $parameters, $pageSize);
            }

            // Lakukan request
            $response = Http::withOptions([
                'verify' => false
            ])->withHeaders($headers)
                ->get($this->baseUrl . $endpoint, $parameters);

            if (!$response->successful()) {
                throw new \Exception("SAP B1 API request failed: " . $response->body());
            }

            // Return response dengan format yang konsisten
            return [
                'data' => $response->json()['value'] ?? [],
                'total' => $this->getTotalCount($endpoint, $parameters),
                'skip' => $parameters['$skip'],
                'pageSize' => $pageSize
            ];
        } catch (\Exception $e) {
            Log::error("SAP B1 API error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get single record by ID
     */
    public function getById($endpoint, $id, $parameters = [])
    {
        try {
            $response = Http::withOptions([
                'verify' => false
            ])->withHeaders([
                'Cookie' => "B1SESSION={$this->sessionId}",
                'Content-Type' => 'application/json'
            ])->get($this->baseUrl . $endpoint . "('" . $id . "')", $parameters);

            if (!$response->successful()) {
                throw new \Exception("SAP B1 API request failed: " . $response->body());
            }

            return $response->json();
        } catch (\Exception $e) {
            Log::error("SAP B1 API error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Post data to SAP
     */
    public function post($endpoint, $data)
    {
        try {
            $response = Http::withOptions([
                'verify' => false
            ])->withHeaders($this->defaultHeaders)
                ->post($this->baseUrl . $endpoint, $data);

            if (!$response->successful()) {
                throw new \Exception("SAP B1 API request failed: " . $response->body());
            }

            return $response->json();
        } catch (\Exception $e) {
            Log::error("SAP B1 API error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Update data
     */
    public function patch($endpoint, $id, $data)
    {
        try {
            $response = Http::withOptions([
                'verify' => false
            ])->withHeaders($this->defaultHeaders)
                ->patch($this->baseUrl . $endpoint . "('" . $id . "')", $data);

            if (!$response->successful()) {
                throw new \Exception("SAP B1 API request failed: " . $response->body());
            }

            return $response->json();
        } catch (\Exception $e) {
            Log::error("SAP B1 API error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete record
     */
    public function delete($endpoint, $id)
    {
        try {
            $response = Http::withOptions([
                'verify' => false
            ])->withHeaders($this->defaultHeaders)
                ->delete($this->baseUrl . $endpoint . "('" . $id . "')");

            if (!$response->successful()) {
                throw new \Exception("SAP B1 API request failed: " . $response->body());
            }

            return $response->successful();
        } catch (\Exception $e) {
            Log::error("SAP B1 API error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Get total count of records
     */
    protected function getTotalCount($endpoint, $parameters)
    {
        try {
            // Remove pagination parameters
            $countParameters = array_diff_key($parameters, array_flip(['$skip', '$top']));

            $response = Http::withOptions([
                'verify' => false
            ])->withHeaders([
                'Cookie' => "B1SESSION={$this->sessionId}",
                'Content-Type' => 'application/json'
            ])->get($this->baseUrl . $endpoint . '/$count', $countParameters);

            return (int) $response->body();
        } catch (\Exception $e) {
            Log::error("Failed to get total count: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Fetch all data with automatic pagination
     */
    protected function fetchAllData($endpoint, $parameters, $pageSize)
    {
        $allData = [];
        $skip = 0;
        $totalProcessed = 0;
        $total = $this->getTotalCount($endpoint, $parameters);

        while ($totalProcessed < $total) {
            $parameters['$skip'] = $skip;

            $response = Http::withOptions([
                'verify' => false
            ])->withHeaders([
                'Cookie' => "B1SESSION={$this->sessionId}",
                'Content-Type' => 'application/json',
                'Prefer' => "odata.maxpagesize={$pageSize}"
            ])->get($this->baseUrl . $endpoint, $parameters);

            if (!$response->successful()) {
                throw new \Exception("SAP B1 API request failed: " . $response->body());
            }

            $data = $response->json()['value'] ?? [];
            $allData = array_merge($allData, $data);

            $totalProcessed += count($data);
            $skip += $pageSize;

            if ($totalProcessed < $total) {
                usleep(100000); // 100ms delay
            }
        }

        return [
            'data' => $allData,
            'total' => $total,
            'pageSize' => $pageSize
        ];
    }

    public function logout()
    {
        try {
            if ($this->sessionId) {
                $response = Http::withOptions([
                    'verify' => false
                ])->withHeaders([
                    'Cookie' => "B1SESSION={$this->sessionId}"
                ])->post($this->baseUrl . 'Logout');

                $this->sessionId = null;
                return $response->successful();
            }
            return true;
        } catch (\Exception $e) {
            Log::error("SAP B1 Logout error: " . $e->getMessage());
            throw $e;
        }
    }

    public function __destruct()
    {
        if ($this->sessionId) {
            try {
                $this->logout();
            } catch (\Exception $e) {
                Log::error("Failed to logout during destruction: " . $e->getMessage());
            }
        }
    }
}
