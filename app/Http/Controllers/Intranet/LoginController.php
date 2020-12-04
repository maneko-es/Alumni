<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Controllers\Controller;
use View;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends IntranetController
{  

	public $user;

    public function testUser(){
        dd('access');
    }
}
?>