<?php
declare(strict_types=1);
namespace APP\Middleware;

use Framework\Request;
use Framework\Response;
use Framework\MiddlewareInterface;
use Framework\RequestHandlerInterface;


class ChangeRequestExample implements MiddlewareInterface{
    public function process(Request $request ,RequestHandlerInterface $next): Response
    {
        $request->post = array_map('trim',$request->post);
        $response =$next->handle($request);    
        return $response;

    }
}