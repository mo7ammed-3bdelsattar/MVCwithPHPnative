<?php
declare(strict_types=1);
namespace Framework;
class Response{
    private string $body ="";
    private array $headers =[];
    private int $statusCode = 0;
    public function setStatusCode(int $code){
        $this->statusCode = $code;
    }
    public function addHeader(string $header): void{
        $this->headers[] = $header;
    }
    public function redirect(string $url): void{
        $this->addHeader("Location: $url");
    }
    public function setBody(string $body){
        $this->body =$body;
    }
    public function getBody(){
        return $this->body;
    }
    public function send(){
        if ($this->statusCode) {
            http_response_code($this->statusCode);
        }
        foreach ($this->headers as $header) {
            header($header);
        }
        echo $this->body;
    }

}