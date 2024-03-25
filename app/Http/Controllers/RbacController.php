<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class RbacController extends Controller
{
    public function actionIndex()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // Roles

        $guest  = $auth->createRole('guest');
        $user  = $auth->createRole('user');
        $manager  = $auth->createRole('manager');
        $admin  = $auth->createRole('admin');

        $auth->add($guest);
        $auth->add($user);
        $auth->add($manager);
        $auth->add($admin);

        // Permissions

        $login  = $auth->createPermission('login');
        $logout = $auth->createPermission('logout');
        $accessAdminka = $auth->createPermission('accessAdminka');
        $createPage = $auth->createPermission('createPage');
        $createUser = $auth->createPermission('createUser');
        $createManager  = $auth->createPermission('createManager');
        $createAdmin   = $auth->createPermission('createAdmin');

        $auth->add($login);
        $auth->add($logout);
        $auth->add($accessAdminka);
        $auth->add($createPage);
        $auth->add($createUser);
        $auth->add($createManager);
        $auth->add($createAdmin);

        // Role Permissions

        // Guest
        $auth->addChild($guest, $login);

        // User
        $auth->addChild($user, $accessAdminka);
        $auth->addChild($user, $logout);

        // Manager
        $auth->addChild($manager, $createPage);
        $auth->addChild($manager, $createUser);
        $auth->addChild($manager, $user);

        // Admin
        $auth->addChild($admin, $createManager);
        $auth->addChild($admin, $createAdmin);
        $auth->addChild($admin, $manager);


    }
}