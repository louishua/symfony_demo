<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
$loader = require __DIR__.'/../app/autoload.php';
$request = Request::createFromGlobals();
$path = $request->getPathInfo(); // the URI path being requested

if (in_array($path, array('', '/'))) {
    $response = new Response('Welcome to the homepage.');
} elseif ('/contact' === $path) {
    $response = new Response('Contact us');
} else {
    $response = new Response('Page not found.', Response::HTTP_NOT_FOUND);
}
$response->send();

/*
$request = Request::createFromGlobals();

// the URI being requested (e.g. /about) minus any query parameters

$t = $request->server->get('SCRIPT_NAME');

$pathInfo = $request->getPathInfo();


// retrieve $_GET and $_POST variables respectively
$foo = $request->query->get('foo');

$request->request->get('bar', 'default value if bar does not exist');

// retrieve $_SERVER variables
$request->server->get('HTTP_HOST');

// retrieves an instance of UploadedFile identified by foo
$request->files->get('foo');

// retrieve a $_COOKIE value
$request->cookies->get('PHPSESSID');

// retrieve an HTTP request header, with normalized, lowercase keys
$request->headers->get('host');
$request->headers->get('content_type');

$request->getMethod();    // GET, POST, PUT, DELETE, HEAD
$request->getLanguages(); // an array of languages the client accepts
*/