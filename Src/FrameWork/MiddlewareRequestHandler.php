<?php

declare(strict_types=1);

namespace Framework;

class MiddlewareRequestHandler implements RequestHandlerInterface
{
    public function __construct(
        private array $middleware,
        private ControllerRequestHandler $controller_handler
    ) {}

    public function handle(Request $request): Response
    {
        $middelware = array_shift($this->middleware);
        if ($middelware === null) {
            return $this->controller_handler->handle($request);
        }
        return $middelware->process($request, $this);
    }
}
