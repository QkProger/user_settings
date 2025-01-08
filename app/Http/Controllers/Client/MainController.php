<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Music;
use App\Models\UserAlbum;
use App\Models\UserMusic;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.index');
    }
}
