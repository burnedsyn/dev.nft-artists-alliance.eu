<?php

use \Phalcon\Di\FactoryDefault;
use \Phalcon\Loader;
use \Phalcon\Mvc\View;
use \Phalcon\Mvc\Application;
use \Phalcon\Url;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Stream;
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Flash\Session as FlashSession;
// Define some absolute path constants to aid in locating resources
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

// Register an autoloader
$loader = new Loader();

$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
    ]
);

$loader->register();

$container = new FactoryDefault();

$container->set(
    'session',
    function () {
        $session = new Manager();
        $files = new Stream(
            [
                'savePath' => '/tmp',
            ]
        );

        $session
            ->setAdapter($files)
            ->start();

        return $session;
    }
);

$container->set(
    'view',
    function () {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/views/');
        return $view;
    }
);

$container->set(
    'url',
    function () {
        $url = new Url();
        $url->setBaseUri('/');
        return $url;
    }
);
$container->set(
    'db',
    function () {
        return new Mysql(
            [
                'host'     => '127.0.0.1',
                'username' => 'kaerdon',
                'password' => 'vKC2ELvR6k,bFC7',
                'dbname'   => 'tennisclub',
            ]
        );
    }
);


// Set up the flash service
$container->set(
    'flash',
    function () {
        return new FlashDirect();
    }
);

// Set up the flash session service
$container->set(
    'flashSession',
    function () {
        return new FlashSession();
    }
);

/* TIM    */



/* /////Tim */
$menu=['Team'=>'team','Collection'=>'nftcollection','about'=>"about"];

$application = new Application($container);

$application->view->setVar('menus',$menu);

/* add asset css and js Tim */

//$application->assets->addCss("css/style.css");
$application->assets->collection('css')->addCss(
    '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
    false,
    false,
    [
        "media"       => "screen,projection",
        "integrity"   => "sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T",
        "crossorigin" => "anonymous"
    ]
)
->addCss('css/style.css', true, true, [
    "media" => "screen,projection"
]);

$footerCollection = $application->assets->collection('js');
//$footerCollection->setPrefix('/');
$footerCollection->addJs('//code.jquery.com/jquery-3.3.1.slim.min.js?dc=1.0.0');
$footerCollection->addJs('//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js?dc=1.0.0');
$footerCollection->addJs('https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js');
$footerCollection->addJs('js/block.js');
try {
    // Handle the request
    $response = $application->handle(
        $_SERVER["REQUEST_URI"]
    );

    $response->send();
} catch (\Exception $e) {
    echo 'Exception: ', $e->getMessage();
}