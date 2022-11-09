<?php


namespace NewsSite\Controllers;
use NewsSite\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class RegistrationController
{

    public function __construct(private User $User)
    {
    }

    public function execute(Request $request, Response $response)
    {
        $this->User->registration($userRegistrationData);
    }
}