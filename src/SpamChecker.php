<?php


namespace App;


use Symfony\Component\HttpKernel\HttpClientKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;



class SpamChecker
{
    private $client;
    private $endpoint;

    public function  __construct(HttpClient $client, string $akismetKey)
    {
        $this->client = $client;
        $this->endpoint = sprintf('https://%s.rest.akismet.com/1.1/comment-check', $akismetKey);
    }




}