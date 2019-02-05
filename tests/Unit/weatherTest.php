<?php

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WeatherTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testWeatherStatus()
    {
        $response = $this->get('/store');

        $response->assertStatus(200);
    }

}

?>