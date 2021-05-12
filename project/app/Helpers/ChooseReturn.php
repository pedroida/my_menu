<?php

namespace App\Helpers;

class ChooseReturn
{
    /**
     * Return a configured instance from ChooseReturn
     * @param string $type success|error|info|warning
     * @param string $message Response message
     * @param string $route get route or routeName
     * @param mixed $routeArguments Route arguments when preceded by route name
     * @return ChooseReturn|ResponseJson|ResponseRedirect|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public static function choose(string $type, string $message, $route = null, $routeArguments = null)
    {
        $chooseReturnInstance = new ResponseJson();

        if ($route) {
            $chooseReturnInstance = new ResponseRedirect();
            $chooseReturnInstance->setRoute($route, $routeArguments);
        }

        $chooseReturnInstance->make($type, $message);

        return $chooseReturnInstance->toResponse(request());
    }
}
