<?php

use App\Models\MaintenanceEvent;
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
    $maintenceEvents = new MaintenanceEvent();
    $recurringEvents = $maintenceEvents->getRecurringEvents();
    $maintenceEvents->refreshRecurringBacklog($recurringEvents);
    $events = new \App\Models\Event();
    $array = $events->with('maintenanceEvent')->get();
    return $array;


});
