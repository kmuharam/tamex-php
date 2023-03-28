<?php

namespace Kmuharam\Tamex\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;
use Kmuharam\Tamex\Requests\CreateShipmentRequest;
use Kmuharam\Tamex\Requests\PrintWaybillRequest;
use Kmuharam\Tamex\Requests\ShipmentStatusRequest;
use Kmuharam\Tamex\Responses\CreateShipmentResponse;
use Kmuharam\Tamex\Responses\PrintWaybillResponse;
use Kmuharam\Tamex\Responses\ShipmentStatusResponse;

class TamexServices
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected Client $client;

    /**
     * @var string
     */
    private string $liveUrl = 'https://til.sa/api/v2/';

    /**
     * @var string
     */
    private string $testUrl = 'http://test.til.sa/api/v2/';

    /**
     * Create a new instance of Tamex Services.
     *
     * @param bool $live
     *
     * @return void
     */
    public function __construct(bool $live = false)
    {
        $baseUri = $live ? $this->liveUrl : $this->testUrl;

        $this->client = new Client([
            'base_uri' => $baseUri,
            'allow_redirects' => false,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Create shipment.
     *
     * @param \Kmuharam\Tamex\Requests\CreateShipmentRequest $request
     *
     * @return \Kmuharam\Tamex\Responses\CreateShipmentResponse
     */
    public function createShipment(
        CreateShipmentRequest $request
    ): CreateShipmentResponse {
        try {
            $response = $this->post('create', $request->buildBodyPayload());

            $parsedResponse = json_decode($response->getBody()->getContents());

            return new CreateShipmentResponse($parsedResponse);
        } catch (ClientException $e) {
            $response = $e->getResponse();

            $parsedResponse = json_decode($response->getBody());

            return new CreateShipmentResponse($parsedResponse);
        }
    }

    /**
     * Track shipment status.
     *
     * @param \Kmuharam\Tamex\Responses\ShipmentStatusRequest $request
     *
     * @return \Kmuharam\Tamex\Responses\ShipmentStatusResponse
     */
    public function shipmentStatus(ShipmentStatusRequest $request): ShipmentStatusResponse
    {
        try {
            $response = $this->post('status', $request->buildBodyPayload());

            $parsedResponse = json_decode($response->getBody()->getContents());

            return new ShipmentStatusResponse($parsedResponse);
        } catch (ClientException $e) {
            $response = $e->getResponse();

            $parsedResponse = json_decode($response->getBody());

            return new ShipmentStatusResponse($parsedResponse);
        }
    }

    /**
     * Print shipment waybill.
     *
     * @param \Kmuharam\Tamex\Responses\PrintWaybillRequest $request
     *
     * @return \Kmuharam\Tamex\Responses\PrintWaybillResponse
     */
    public function printWaybill(PrintWaybillRequest $request): PrintWaybillResponse
    {
        try {
            $response = $this->post('print', $request->buildBodyPayload());

            $fileContents = $response->getBody()->getContents();

            return new PrintWaybillResponse($fileContents);
        } catch (ClientException $e) {
            $response = $e->getResponse();

            $parsedResponse = json_decode($response->getBody());

            return new PrintWaybillResponse($parsedResponse);
        }
    }

    /**
     * Send a post request.
     *
     * @param string $url
     * @param array  $payload
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function post(string $url, array $payload = []): Response
    {
        return $this->client->request('POST', $url, [
            RequestOptions::JSON => $payload,
        ]);
    }
}
