<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Routes for main controllers
 */

Route::group(array('before' => 'auth'), function () {

    // Company routes
    require_once('routes/company.routes.php');

    // People routes
    require_once('routes/people.routes.php');

    // Deal routes
    require_once('routes/deal.routes.php');

    // Action routes
    require_once('routes/action.routes.php');

    // Action routes
    require_once('routes/task.routes.php');

    // Configuration routes
    require_once('routes/config.routes.php');

    // Configuration Action Result routes
    // require_once('routes/config/action.results.routes.php');

    // Configuration People Salutation routes
    // require_once('routes/config/people.salutation.routes.php');

    // Users routes
    Route::resource('users', 'Cream\User\Controllers\UserController');
    Route::resource('roles', 'Cream\User\Controllers\RoleController');

    // AJAX routes
    require_once('routes/ajax.routes.php');

    // Misc routes
    require_once('routes/misc.routes.php');

    Route::get('/', function()
    {
        // $action = new Action([
        //         'message'           => 'test message',
        //         'duration'          => 20,
        //         'direction'         => 'output',
        //         'resultable_type'   => 'VisitResult',
        //         'resultable_id'     => 1,
        //         'done_at'           => '0000-00-00 00:00:00',
        //     ]);

        // // dd($action);

        // $element = Company::withTrashed()->find(371);
        // $result = $element->history()->save($action);

        // dd($action->errors());        

        $a = new Lion\Repositories\Company\CompanyRepository();

        return View::make('hello');
    });

    Route::get('test', function() {
        $datetime = new DateTime('18:11:31');

        echo $datetime->format('d M Y H:i');

        // $data = array(
        //     'name' => 'Tarea desde routes.php',
        //     'description' => 'Descripción de la tarea',
        //     'task_type' => 11,
        //     'start_date' => new DateTime('now'),

        //     'assignment' => array(
        //         'company' => 763,
        //         'people' => 574,
        //         'deal' => 8
        //     )
        // );

        // $repo->store($data);

        // $task = Lion\Task::find(19);

        // if ($task->assignments->count())
        // {
        //     echo 'Está asignada! <br/>';
        //     echo 'A quien?:<br/>';
        //     foreach ($task->assignments as $assigned)
        //     {
        //         echo $assigned->assignable->name . '<br/>';
        //     }
            
        // }

        

        //return View::make('hello');
    });

});

// Route::get('test', function() {
//     $a = new Lion\Repositories\Company\CompanyRepository();
// });

// Confide routes
Route::get( 'user/create',                 array('as' => 'user.create', 'uses' => 'UserController@create'));
Route::post('user',                        'UserController@store');
Route::get( 'user/login',                  'UserController@login');
Route::post('user/login',                  'UserController@do_login');
Route::get( 'user/confirm/{code}',         'UserController@confirm');
Route::get( 'user/forgot_password',        array('as' => 'user.login.forgot', 'uses' => 'UserController@forgot_password'));
Route::post('user/forgot_password',        'UserController@do_forgot_password');
Route::get( 'user/reset_password/{token}', 'UserController@reset_password');
Route::post('user/reset_password',         array('as' => 'user.login.doreset', 'uses' => 'UserController@do_reset_password'));
Route::get( 'user/logout',                 array('as' => 'user.login.logout', 'uses' => 'UserController@logout'));
