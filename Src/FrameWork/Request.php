<?php
declare(strict_types=1);
namespace Framework;
class Request{

    public function __construct(public string $uri,
                                public string $method,
                                public array $get,
                                public array $post,
                                public array $files,
                                public array $cookies,
                                public array $server,){}
    public static function createFromGlobals()
    {
        return new static(
            uri: $_SERVER["REQUEST_URI"],
            method: $_SERVER["REQUEST_METHOD"],
            get: $_GET,
            post: $_POST,
            files: $_FILES,
            cookies: $_COOKIE,
            server: $_SERVER
        );
    }
}