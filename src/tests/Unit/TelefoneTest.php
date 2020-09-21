<?php

namespace Tests\Unit;

use App\Http\Controllers\api\TelefoneController;
use Tests\TestCase;


class TelefoneTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetAllTelefone()
    {
        $controller = new TelefoneController();
        $response = $controller->index();
        $this->assertJson($response);
    }
    public function testGetIdTelefone(){
        $controller = new TelefoneController();
        $response = $controller->show(1);
        $this->assertJson($response);
    }
}
