<?php

namespace Tests\Unit;

use App\Http\Controllers\api\EspMedController;
use Tests\TestCase;

class EspMedsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetAllEspMeds()
    {
        
        $controller = new EspMedController();
        $reponse = $controller->index();
        $this->assertJson($reponse);
    
    }
    
    public function testGetIdEspMeds()
    {
        
        $controller = new EspMedController();
        $reponse = $controller->show(1);
        $this->assertJson($reponse);
    
    }
}
