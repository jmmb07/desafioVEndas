<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
   private User $user;
   public function __construct(User $user) 
   {
      $this->user = $user;
   }
   public function criausuario (array $data) 
   {    
      $data['role'] = 'user';
      return $this->user->create($data);
   }
   public function criavendedor (array $data) 
   {    
      $data['role'] = 'vendedor';
      return $this->user->create($data);
   }
   public function getvendas($dataInicio, $dataFim)
   {
      $query = Vendedor::query();
      //dd($dataInicio);
       
      if ($dataInicio && $dataFim) 
       {
          $query->whereBetween('data_venda', [$dataInicio, $dataFim]);
       }
       
      $vendas = $query->get();
       
      return $vendas;
   }

   public function getvendasbyid($idVendedor)
   {
      $query = Vendedor::query();

      $query->where('id_vendedor', $idVendedor);
      //dd($idVendedor);       
      $vendas = $query->get();
       
      return $vendas;
   }   
}


