<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\VendedorRequest;
use App\Models\User;
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
    public function vendedoresIndex() 
    {

        $response = $this->userService->getvendedores();

        foreach ($response as $vendedor)
        {
            $vendedores[] = $vendedor->getAttributes();
        }

        return response()->json($vendedores);
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
    
    public function registerVendas(VendedorRequest $request) 
    {
        $validated = $request->validated();
        $validated['id_vendedor'] = $request->id_vendedor;

        // Verificar se o usuário com o ID especificado é um vendedor
        $user = User::where('id', $request->id_vendedor)->where('role', 'vendedor')->first();
        
        if (!$user) {
            return response()->json(['error' => 'O usuario correspondente nao tem a funcao vendedor.'], 403);
        }

        $response = $this->userService->registraVenda($validated);

        return response()->json(
            [
                'message' => 'Venda registrada!',
            ]
        );
    }
}
