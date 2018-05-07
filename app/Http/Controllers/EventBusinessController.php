<?php

namespace App\Http\Controllers;

use App\Model\EventBusiness;
use Illuminate\Http\Request;

class EventBusinessController extends Controller
{
    public function index()
    {
        $eventBusinesses = EventBusiness::paginate(5);
        return view('eventBusiness.index',compact('eventBusinesses'));
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
