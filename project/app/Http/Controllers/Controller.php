<?php

namespace App\Http\Controllers;

use App\Builders\PaginationBuilder;
use App\Helpers\ChooseReturn;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $repository;
    protected $resource;

    /**
     * Retorna a paginação completa.
     *
     *  Cria o construtor de paginação, delega a configuração para o hook 'getPagination'
     * e retorna a paginação construída.
     *
     * @return PaginationBuilder
     */
    public function pagination()
    {
        $pagination = new PaginationBuilder();
        $this->getPagination($pagination);
        return $pagination->build();
    }

    /**
     * Configura a paginação.
     *
     * @param PaginationBuilder $pagination
     * @return void
     */
    protected function getPagination($pagination)
    {
        $pagination->repository($this->repository)
            ->resource($this->resource);
    }

    /**
     * Escolhe a forma correta de retorno (XHR ou Redirect).
     *
     * @param string $type Tipo do retorno ('error', 'success', 'info', 'warning')
     * @param string $message Mensagem de retorno.
     * @param string $routeToRedirect Rota para redirecionamento caso não seja XHR.
     * @return mixed JSON ou Redirect;
     */
    public function chooseReturn($type, $message, $routeToRedirect = null, $id = null)
    {
        return ChooseReturn::choose($type, $message, $routeToRedirect, $id);
    }
}
