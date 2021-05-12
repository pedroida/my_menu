<?php

namespace App\Helpers;

use App\Contracts\ResponseInterface;
use Illuminate\Contracts\Support\Responsable;

class ResponseJson implements Responsable, ResponseInterface
{
    /**
     * Response type
     * @var string
     */
    private $type;

    /**
     * Response Message
     * @var string
     */
    private $message;

    /**
     * Return a configured instance from ChooseReturn
     * @param string $type success|error|info|warning
     * @param string $message Response message
     * @param string $route get route or routeName
     * @param mixed $routeArguments Route arguments when preceded by route name
     * @return self Configured ChooseReturn
     */
    public function make($type, $message)
    {
        $this->setType($type);
        $this->setMessage($message);

        return $this;
    }

    /**
     * Set response type
     * @param string $type success|error|info|warning
     */
    public function setType($type)
    {
        if (!in_array($type, ['success', 'error', 'info', 'warning'])) {
            throw new \InvalidArgumentException("Invalid response type [{$type}]", 500);
        }

        $this->type = $type;
        return $this;
    }

    /**
     * Set response message
     * @param string $message Response message
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        $response = [
            'type' => $this->type,
            'message' => $this->message ?? null,
        ];

        $code = ($this->type === 'error') ? 202 : 200;

        return response(json_encode($response), $code);
    }
}
