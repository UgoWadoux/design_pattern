<?php

interface UserInterface
{
    public function getRole();
}

class Admin implements UserInterface
{
    static $role = 'Admin';
    public function getRole()
    {
        return self::$role;
    }
}

class Moderator implements UserInterface
{
    static $role = 'Moderator';
    public function getRole()
    {
        return self::$role;
    }
}
class User implements UserInterface {
    static $role = 'User';

    public function getRole()
    {
        return self::$role;
    }
}
class UserFactory
{
    static function createUser($role)
    {
        switch ($role) {
            case 'Admin':
                return new Admin();
            case 'Moderator':
                return new Moderator();
            case 'User':
                return new User();
            default:
                return null;
        }
    }
}
$admin = UserFactory::createUser('Admin');
echo $admin->getRole(). "\n";
$moderator = UserFactory::createUser('Moderator');
echo $moderator->getRole(). "\n";
$user = UserFactory::createUser('User');
echo $user->getRole(). "\n";
