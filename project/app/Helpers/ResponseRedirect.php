<?php

namespace App\Helpers;

use App\Contracts\ResponseInterface;
use Illuminate\Contracts\Support\Responsable;

class ResponseRedirect implements Responsable, ResponseInterface
{
    /**
     * Response type
     * @var string
     */
    private $type;

    /**
     * Response payload
     * @var mixed
     */
    private $data;

    /**
     * Redirection route
     * @var string
     */
    private $route;

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
     * Set redirection route
     * @param string $route get route or routeName
     * @param mixed $routeArguments When preceded by route name, route arguments
     */
    public function setRoute($route, $routeArguments = null)
    {
        $this->route = is_valid_url($route)
            ? $route
            : route($route, $routeArguments);

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
     * Set payload data
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toResponse($request)
    {
        flash()->create($this->type, $this->message);
        return redirect()->to($this->route);
    }
}
