<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function userRegister(UserRequest $request)
    {
        $validated = $request->validated();

        $response = $this->userService->criausuario($validated);
        
        //dd($validated); 
        
        return response()->json(
            [
                'message' => 'Usuario registrado com sucesso!',
            ]
        );
    }

    public function vendedorRegister(UserRequest $request)
    {
        $validated = $request->validated();

        $response = $this->userService->criavendedor($validated);
        
        //dd($validated); 
        
        return response()->json(
            [
                'message' => 'Vendedor registrado com sucesso!',
            ]
        );
    }
    public function vendasIndex(Request $request) 
    {

        $response = $this->userService->getvendas($request->dataInicio, $request->dataFim);

        foreach ($response as $venda)
        {
            $vendas[] = $venda->getAttributes();
        }

        return response()->json($vendas);
    }

    public function indexVendasId(Request $request) 
    {

        $response = $this->userService->getvendasbyid($request->id_vendedor);
        $vendas = [];
        
        if ($response->isEmpty()) {
            return response()->json(['message' => 'Nenhuma venda encontrada para o vendedor com o ID especificado.'], 404);
        }

        foreach ($response as $venda)
        {
            $vendas[] = $venda->getAttributes();
        }

        return response()->json($vendas);
    }

}
