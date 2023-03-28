<?php

namespace Kmuharam\Tamex\Responses;

use stdClass;

class ShipmentStatusResponse extends AbstractResponse
{
    /**
     * @var string
     */
    public string $awb = '';

    /**
     * @var string
     */
    public string $status = '';

    /**
     * @var string
     */
    public string $updateOn = '';

    /**
     * @var string
     */
    public string $message = '';

    /**
     * Create a new instance of Shipment Status Response.
     *
     * @param stdClass $rawResponse
     *
     * @return void
     */
    public function __construct(stdClass $rawResponse)
    {
        $this->raw = $rawResponse;

        if (property_exists($rawResponse, 'code')) {
            $this->code = $rawResponse->code;
            $this->data = $rawResponse->data;
        } else {
            $this->awb = $rawResponse->awb;
            $this->status = $rawResponse->status;
            $this->updateOn = $rawResponse->UpdateOn;
            $this->message = $rawResponse->message;
        }
    }

    /**
     * Returns true if the shipment exists and found.
     *
     * @return bool
     */
    public function exists(): bool
    {
        return ! empty($this->awb);
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
            'exists' => $this->exists(),
            'code' => $this->code,
            'data' => $this->data,
            'awb' => $this->awb,
            'status' => $this->status,
            'updateOn' => $this->updateOn,
            'message' => $this->message,
        ];
    }
}
