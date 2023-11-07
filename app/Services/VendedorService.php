<?php

namespace App\Services;

use App\Http\Requests\VendedorRequest;
use App\Models\Vendedor;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class VendedorService
{
   private Vendedor $vendedor;
   public function __construct(Vendedor $vendedor) 
   {
        $this->vendedor = $vendedor;
   }

   public function registraVenda(array $data) 
   {
      $data['id_vendedor'] = auth()->user()->id; //usuario logado
      //dd($data);
      return $this->vendedor->create($data);
   }
   public function getvendedorvendasid($dataInicio, $dataFim)
   {
      $idUsuarioLogado = auth()->user()->id;
      //dd($dataInicio);
      $query = $this->vendedor->where('id_vendedor', $idUsuarioLogado);
       
      if ($dataInicio && $dataFim) 
       {
          $query->whereBetween('data_venda', [$dataInicio, $dataFim]);
       }
       
      $vendas = $query->get();
       
      return $vendas;
   }
   
}


