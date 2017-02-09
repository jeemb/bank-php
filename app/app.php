<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/account.php";

    session_start();

    if (empty($_SESSION['bank_accounts'])) {
        $_SESSION['bank_accounts'] = array();
    }

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../view'
    ));

    // home page has input for places
    $app->get("/", function() use ($app) {
        return $app['twig']->render('create.html.twig');
    });

    $app->post("/new", function() use ($app) {
        $namer = $_POST['name'];
        $passworder = $_POST['password'];
        $amounter = $_POST['amount'];
        $user = new Account($namer, $passworder, $amounter);
        $user->save();
        return $app['twig']->render('new.html.twig');
    });

    // validate page for user to sign back in to see their account amount
    $app->post("/validate", function() use ($app) {
        $namer = $_POST['name'];
        $passworder = $_POST['password'];
        $accounts = Account::getAll();
        foreach ($accounts as $account) {
            if ($namer == $account->getName() && $passworder == $account->getPassword()) {
                echo $account->getAmount();
            };
        }
        return $app['twig']->render('validate.html.twig', Account::getAll());
    });

    // If identity verified, amount is shown
    $app->post("/update", function() use ($app) {





        return $app['twig']->render('create.html.twig');
    });

    return $app;
?>
