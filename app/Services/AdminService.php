<?php

namespace App\Services;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class AdminService
{
   private Admin $admin;
   public function __construct(Admin $admin) 
   {
        $this->admin = $admin;
   }


}


