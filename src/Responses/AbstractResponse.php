<?php

namespace Kmuharam\Tamex\Responses;

use stdClass;

abstract class AbstractResponse
{
    /**
     * @var string|stdClass
     */
    public string|stdClass $raw;

    /**
     * @var int
     */
    public int $code = 0;

    /**
     * @var string
     */
    public string $data = '';

    /**
     * Returns true if there is an API error.
     *
     * @return bool
     */
    public function hasError(): bool
    {
        return (bool) $this->code;
    }
}
