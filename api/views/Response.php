<?php
class Response {
    public static function sendResponse($statusCode, $data) {
        header("Content-Type: application/json");
        http_response_code($statusCode);
        echo json_encode($data);
        exit();
    }

    public static function okResponse($data) {
        self::sendResponse(200, $data);
    }

    public static function createdResponse($data) {
        self::sendResponse(201, $data);
    }

    public static function unprocessableEntityResponse($message = "Unprocessable entity") {
        self::sendResponse(422, ["error" => $message]);
    }

    public static function notFoundResponse($message = "Resource not found") {
        self::sendResponse(404, ["error" => $message]);
    }
}
?>
