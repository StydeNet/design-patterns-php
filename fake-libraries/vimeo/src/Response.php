<?php

namespace Vimeo;

class Response
{
    /**
     * @var array
     */
    public $body;

    /**
     * @var int
     */
    public $status;

    /**
     * Response constructor.
     *
     * @param array $body
     * @param int $status
     */
    public function __construct(array $body, int $status)
    {
        $this->body = $body;
        $this->status = $status;
    }
}
