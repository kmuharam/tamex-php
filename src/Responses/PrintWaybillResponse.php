<?php

namespace Kmuharam\Tamex\Responses;

use stdClass;

class PrintWaybillResponse extends AbstractResponse
{
    /**
     * @var string
     */
    public string $contents = '';

    /**
     * Create a new instance of Print Waybill Response.
     *
     * @param string|stdClass $rawResponse
     *
     * @return void
     */
    public function __construct(string|stdClass $rawResponse)
    {
        $this->raw = $rawResponse;

        if (property_exists($rawResponse, 'code')) {
            $this->code = $rawResponse->code;
            $this->data = $rawResponse->data;
        } else {
            $this->contents = $rawResponse;
        }
    }

    /**
     * Returns true if the shipment exists and found.
     *
     * @return bool
     */
    public function exists(): bool
    {
        return ! empty($this->contents);
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
            'contents' => $this->contents,
        ];
    }
}
