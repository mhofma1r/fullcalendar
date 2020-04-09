<?php

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('/events', function (Request $request) {
    $events = Event::all();
    $array = $events->toArray();
    $array[0]['bongo'] = [
        'bloody'=>'marry',
        'type'=>'genitelia'
    ];

    return response()->json($array);
});
