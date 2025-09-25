<?php

namespace App\ApiHelper;

class ApiResponseHelper
{
    public static function sendResponse(Result $result, int $statusCode = ApiResponseCodes::SUCCESS)
    {
        return \Response::json([
            'success' => $result->isOk,
            'message' => $result->message,
            'data' => $result->result ?? null,
        ], $statusCode);
    }

    public static function sendResponseWithPagination(Result $response)
    {
        return \Response::json([
            'success' => $response->isOk,
            'error_code' => null,
            'message' => $response->message,
            'data' => $response->result ?? null,
            'pagination' => $response->paginate ?? null,
        ], ApiResponseCodes::SUCCESS);
    }

    public static function sendSuccessResponse(SuccessResult $response)
    {
        return \Response::json([
            'success' => $response->isOk,
            'error_code' => null,
            'message' => $response->message,
            'data' => null,
            'paginate' => null,
        ], ApiResponseCodes::SUCCESS);
    }

    public static function sendErrorResponse(ErrorResult $response)
    {
        return \Response::json([
            'success' => $response->isOk,
            'error_code' => $response->code,
            'message' => $response->message,
            'data' => null,
            'paginate' => null,
        ], $response->code);
    }

    public static function sendResponse2($result, $message, $code = 200, $errorCode = 0)
    {
        return \Response::json([
            'status' => $code,
            'errorCode' => $errorCode,
            'data' => $result,
            'message' => $message,
        ], $code);
    }

    public static function sendMessageResponse($message, $code = 200, $success = true)
    {
        return \Response::json([
            'success' => $success,
            'message' => $message,
        ], $code);
    }

    public static function sendResponseWithCount(Result $response, $count)
    {
        return \Response::json([
            'success' => $response->isOk,
            'message' => $response->message,
            'count' => $count,
            'data' => $response->result ?? null,
        ], ApiResponseCodes::SUCCESS);
    }

    public static function sendResponseWithKey(Result $response, $array)
    {
        return \Response::json(array_merge($array, [
            'success' => $response->isOk,
            'message' => $response->message,
            'data' => $response->result ?? null,
        ]), ApiResponseCodes::SUCCESS);
    }

    public static function sendResponseOnlyKey($array, $success = true, $message = 'Done', $status = ApiResponseCodes::SUCCESS)
    {
        return \Response::json(array_merge($array, [
            'success' => $success,
            'message' => $message,
        ]), $status);
    }
}
