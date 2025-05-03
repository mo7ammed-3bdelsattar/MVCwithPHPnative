<?php
declare(strict_types=1);
namespace APP\Middleware;

use Framework\Request;
use Framework\Response;
use Framework\MiddlewareInterface;
use Framework\RequestHandlerInterface;


class RedirectExample implements MiddlewareInterface{
    public function __construct(private Response $response){}
    public function process(Request $request ,RequestHandlerInterface $next): Response
    {
        $this->response->redirect("/users/index");
        return $this->response;

    }
}