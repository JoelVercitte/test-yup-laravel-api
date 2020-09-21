<?php

namespace Tests\Unit;

use App\Http\Controllers\api\EspecialidadeController;
use Tests\TestCase;

class EspecialidadeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetAllEspecialidade()
    {
        $controller = new EspecialidadeController();
        $response = $controller->index();
        $this->assertJson($response);
    }
    public function testGetIdEspecialidade(){
        $controller = new EspecialidadeController();
        $response = $controller->show(1);
        $this->assertJson($response);
    }
}
