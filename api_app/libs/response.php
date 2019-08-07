<?php
class Response
{
    public static function responseAndDie($title, $message, $code)
    {
        $response = [$title => $message];
        echo json_encode($response);
        die(http_response_code($code));
    }
}