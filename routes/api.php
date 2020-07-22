<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/provinces', function (\App\Provinces\ProvinceRepository $provinceRepository, Request $request) {
    return $provinceRepository->getAllNames();
});
Route::get('/settings', function (\App\Settings\SettingsProvider $settings, Request $request) {
    return $settings->toArray();
});
Route::post(
    '/date-keys-batches',
    function (
        \App\DateKeys\DateKeysService $service,
        \App\DateKeys\DateKeysRepository $repository,
        \App\Http\Requests\PostDateKeysBatch $request
    ) {
        $validatedData = $request->validated();
        $keys = $service->createDateKeysForInsert(
            $validatedData['range-start'],
            $validatedData['range-stop'],
            $validatedData['letters'],
            $validatedData['uuid']
        );

        $repository->insertMany($keys);

        return response(null, \Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT);
    }
);
