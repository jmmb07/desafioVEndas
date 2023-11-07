<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
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
}


