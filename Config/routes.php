<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
Router::connect('/', array('controller' => 'users', 'action' => 'login', 'admin' => true));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
Router::connect('/users/*', array('controller' => 'users', 'action' => 'login', 'admin' => true));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */

Router::resourceMap(array(
     array('action' => 'api_index', 'method' => 'GET', 'id' => false, 'prefix'=>'api', 'api'=>true),
     array('action' => 'api_view', 'method' => 'GET', 'id' => true, 'prefix'=>'api', 'api'=>true),
     array('action' => 'api_add', 'method' => 'POST', 'id' => false, 'prefix'=>'api', 'api'=>true),
     array('action' => 'api_edit', 'method' => 'PUT', 'id' => true, 'prefix'=>'api', 'api'=>true),
     array('action' => 'api_delete', 'method' => 'DELETE', 'id' => true, 'prefix'=>'api', 'api'=>true),
     array('action' => 'api_edit', 'method' => 'POST', 'id' => true, 'prefix'=>'api', 'api'=>true)
));

Router::connect('/subadmin', array('controller' => 'users', 'action' => 'login', 'subadmin' => true));
Router::connect('/admin', array('controller' => 'users', 'action' => 'login', 'admin' => true));
Router::connect('/garage', array('controller' => 'users', 'action' => 'login', 'garage' => true));


Router::mapResources(array('agents'), array('prefix'=>'api', 'api'=>true));
Router::parseExtensions();
Router::setExtensions(array('json','xml'));

require CAKE . 'Config' . DS . 'routes.php';

