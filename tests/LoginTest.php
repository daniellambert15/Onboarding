<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/')
            ->type('daniel.lambert@gas-elec.co.uk', 'email')
            ->type('7encoeaz', 'password')
            ->press('submit')
            ->see('You\'ve logged into your online dashboard');
    }
}
