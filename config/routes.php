<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    //ユーザ一
    $routes->connect('/',                              ['controller' => 'Users', 'action' => 'index']);
    $routes->connect('/users/login',                   ['controller' => 'Users','action' => 'login']);
    $routes->connect('/users/logout',                  ['controller' => 'Users','action' => 'logout']);
    $routes->connect('/users/add',                     ['controller' => 'Users','action' => 'add']);

    //ajax
    $routes->connect('/ajax/add_micropost',            ['controller' => 'Ajax','action' => 'addMicropost']);

    //レッスン
    $routes->connect('/lesson/',                       ['controller' => 'Lessons','action' => 'index']);
    $routes->connect('/lesson/lesson0',                ['controller' => 'Lessons','action' => 'lesson0']);
    $routes->connect('/lesson/lesson4',                ['controller' => 'Lessons','action' => 'lesson4']);
    $routes->connect('/lesson/lesson5',                ['controller' => 'Lessons','action' => 'lesson5']);

    $routes->connect('/lesson/base1',                  ['controller' => 'Bases','action' => 'base1']);
    $routes->connect('/lesson/base2',                  ['controller' => 'Bases','action' => 'base2']);
    $routes->connect('/lesson/base3',                  ['controller' => 'Bases','action' => 'base3']);
    $routes->connect('/lesson/base4',                  ['controller' => 'Bases','action' => 'base4']);

    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
