<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

abstract class CrudController extends Controller
{
    protected $service;

    public function __construct() {
    }

    /**
     * Mostra uma lista de Recursos.
     *
     * @param Request
     * @return object
     */
    public function index(Request $request)
    {
        return response()->json($this->service->list($this->prepareFilters($request->all())));
    }

    /**
     * Exibe o recurso especificado.
     *
     * @param Request
     * @param integer $id
     * @return object
     */
    public function show(Request $request, $id)
    {
        return response()->json($this->service->search($this->prepareFilters($request->all()), $id));
    }

    /**
     * Cadastra um novo recurso no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return object
     */
    public function store(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => $this->service->save($this->prepareData($request->all()))
        ]);
    }

    /**
     * Altera um recurso especifico no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return object
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        return response()->json([
            'status' => true,
            'data' => $this->service->update($id, $this->prepareData($data))
        ]);
    }

    /**
     * Remove um recurso especifico do banco de dados.
     *
     * @param  int  $id
     * @return object
     */
    public function destroy(Request $request, $id) {

        $data = $request->all();
        if(!isset($data['is_delete'])){
            $data['is_delete'] = true;
        }
        return response()->json([
            'status' => true,
            'data' => $this->service->delete($this->prepareData($data), $id)
        ]);
    }


    /**
     * Prepara os dados dos filtros do Index.
     *
     * @param array $data
     * @return array
     */
    protected function prepareFilters($data)
    {
        return $data;
    }

    /**
     * Prepara os dados da requisição;
     *
     * @param Request
     * @return array
     */
    protected function prepareData($data)
    {
        if(isset($data['is_delete']) && $data['is_delete'] == false){
            $data["deleted_at"] = new \DateTime();
        }
        return $data;
    }

    /**
     * Failed Request
     *
     * @return object
     */
    protected function responseFailedRequest()
    {
        return response()->json([
            "status" => false,
            "status_code" => 500,
            "message" => ""
        ]);
    }

}
