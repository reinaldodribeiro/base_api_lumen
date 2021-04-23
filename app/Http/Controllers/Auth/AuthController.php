<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mockery\Exception;

class AuthController extends Controller
{
    /**
     * Controlador para realizar login no sistema e retornar o jwt.
     * @route Route::post('/login', 'Auth\AuthController@login');
     * URI 'api/login'
     * @method POST
     *
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        $creds = $request->only(['email','password']);

        if(!$token = auth()->attempt($creds)){
            return response()->json([
                "status" => false,
                "status_code" => 401,
                "errors" => [
                    "autentication" => ["E-mail ou senha inválido !"]
                ]
            ] , 401);
        }else{
            return response()->json([
                'token' => $token,
                'token_type' => 'bearer'
            ]);
        }
    }

    /**
     * Controlador para realizar logout do sistema.
     * @route Route::middleware('auth:api')->post('/logout', 'Auth\AuthController@logout');
     * URI 'api/login'
     * @method POST
     *
     * @return mixed
     */
    public function logout()
    {
        try {

            auth()->logout();

            return response()->json([
                'status' => 'success'
            ]);

        } catch (Exception $e) {
            return response()->json(array('return' => false, "errors" => $e));
        }

    }
}
