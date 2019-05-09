<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Inside\Helpers;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    protected $help;

    function __construct()
    {
        $this->help = new Helpers();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welCome()
    {
        $this->help->getMenuInfo(Auth::user()->id);
        return view('admin.welcome');
    }


}
