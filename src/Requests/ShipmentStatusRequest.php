<?php

namespace Kmuharam\Tamex\Requests;

class ShipmentStatusRequest
{
    /**
     * @var string
     */
    public string $apiKey = '';

    /**
     * @var string
     */
    public string $packAWB = '';

    /**
     * Returns an array representation of the request body payload.
     *
     * @return array
     */
    public function buildBodyPayload(): array
    {
        return [
            'apikey' => $this->apiKey,
            'pack_awb' => $this->packAWB,
        ];
    }
}
