<?php

namespace Kmuharam\Tamex\Responses;

use stdClass;

class CreateShipmentResponse extends AbstractResponse
{
    /**
     * @var string
     */
    public string $tmxAWB = '';

    /**
     * Create a new instance of Create Shipment Response.
     *
     * @param stdClass $rawResponse
     *
     * @return void
     */
    public function __construct(stdClass $rawResponse)
    {
        $this->raw = $rawResponse;

        $this->code = $rawResponse->code;
        $this->data = $rawResponse->data;

        if (! $this->hasError()) {
            $this->tmxAWB = $rawResponse->tmxAWB;
        }
    }

    /**
     * Returns true if the shipment was created successfully.
     *
     * @return bool
     */
    public function created(): bool
    {
        return ! empty($this->tmxAWB);
    }

    /**
     * Get detailed shipment status response.
     *
     * @return array
     */
    public function response(): array
    {
        return [
            'error' => $this->hasError(),
            'created' => $this->created(),
            'code' => $this->code,
            'data' => $this->data,
            'tmxAWB' => $this->tmxAWB,
        ];
    }
}
