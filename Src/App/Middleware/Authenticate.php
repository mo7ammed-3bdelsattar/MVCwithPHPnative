<?php
declare(strict_types=1);
namespace App\Middleware;

use Framework\Request;
use Framework\Response;
use Framework\MiddlewareInterface;
use Framework\RequestHandlerInterface;
class Authenticate implements MiddlewareInterface{

    public function __construct(private Response $response){}
    public function process(Request $request, RequestHandlerInterface $next): Response
    {
        // session_start();
        if (!isset($request->session['auth'])) {
            $this->response->redirect('/login');
            return $this->response;
        }
        return $next->handle($request);
    }

}