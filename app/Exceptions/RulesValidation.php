<?php

namespace App\Exceptions;

use Illuminate\Http\Exceptions\HttpResponseException;

class RulesValidation extends HttpResponseException
{

    /**
     * The underlying response instance.
     *
     * @var \Symfony\Component\HttpFoundation\Response
     */
    protected $response;

    protected $errors = [];

    /**
     * Create a new HTTP response exception instance.
     *
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return void
     */
    public function __construct($errors)
    {
        $this->response = response()->json([
            "status" => false,
            "errors" => $errors,
            "message" => "The given data was invalid.",
            "status_code" => $this->status
        ], $this->status);
    }

    /**
     * The status code to use for the response.
     *
     * @var int
     */
    public $status = 422;

    public function getResponse()
    {
        return $this->response;
    }

}
