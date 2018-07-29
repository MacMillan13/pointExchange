<?php

namespace tests\models;

use app\models\User11;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = User11::findIdentity(100));
        expect($user->username)->equals('admin');

        expect_not(User11::findIdentity(999));
    }

    public function testFindUserByAccessToken()
    {
        expect_that($user = User11::findIdentityByAccessToken('100-token'));
        expect($user->username)->equals('admin');

        expect_not(User11::findIdentityByAccessToken('non-existing'));
    }

    public function testFindUserByUsername()
    {
        expect_that($user = User11::findByUsername('admin'));
        expect_not(User11::findByUsername('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = User11::findByUsername('admin');
        expect_that($user->validateAuthKey('test100key'));
        expect_not($user->validateAuthKey('test102key'));

        expect_that($user->validatePassword('admin'));
        expect_not($user->validatePassword('123456'));        
    }

}
