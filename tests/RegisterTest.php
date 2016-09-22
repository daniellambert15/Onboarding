<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/register')
            ->type('Daniel Lambert3', 'name')
            ->type('daniel.lambert'.rand(1,500000).'@gas-elec.co.uk', 'email')
            ->type('gas-elec-'.rand(1,500000), 'business_name')
            ->type(rand(1,500000).''.rand(1,500000).''.rand(1,500000).''.rand(1,500000).''.rand(1,500000).''.rand(1,500000), 'contact_number')
            ->type('7encoeaz', 'password')
            ->type('7encoeaz', 'password_confirmation')
            ->press('submit')
            ->see('Thank you for signing up');
    }
}
