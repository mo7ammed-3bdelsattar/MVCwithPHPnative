<?php
declare(strict_types=1);
namespace APP\Middleware;

use Framework\Request;
use Framework\Response;
use Framework\MiddlewareInterface;
use Framework\RequestHandlerInterface;


class ChangeResponsExample implements MiddlewareInterface{
    public function process(Request $request ,RequestHandlerInterface $next): Response
    {
        $response =$next->handle($request);
        $response->setBody($response->getBody() . " - Middleware added this text.");
    
        return $response;

    }
}