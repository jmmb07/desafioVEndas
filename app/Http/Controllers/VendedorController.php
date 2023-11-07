<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendedorRequest;
use App\Services\VendedorService;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    private VendedorService $vendedorService;

    public function __construct(VendedorService $vendedorService) 
    {
        $this->vendedorService = $vendedorService;
    }

    public function registerVendas(VendedorRequest $request) 
    {
        $validated = $request->validated();

        $response = $this->vendedorService->registraVenda($validated);

        return response()->json(
            [
                'message' => 'Venda registrada!',
            ]
        );
    }

    public function getvendedorvendas(Request $request) 
    {

        $response = $this->vendedorService->getvendedorvendasid($request->dataInicio, $request->dataFim);

        foreach ($response as $venda)
        {
            $vendas[] = $venda->getAttributes();
        }

        return response()->json($vendas);
    }
    
}
