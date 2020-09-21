<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Http\Controllers\api\MedicoController;
//use PHPUnit\Framework\TestCase;
use App\Models\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use function PHPUnit\Framework\assertJson;

class MedicoTest extends TestCase
{
    /**
     * A basic unit test example.
     * 
     * @return void
     */
    public function testGetAllMedico()
    {
        
        $controller = new MedicoController();
        $reponse = $controller->index();
        $this->assertJson($reponse);
    
    }
    
    public function testGetIdMedico()
    {
        
        $controller = new MedicoController();
        $reponse = $controller->show(1);
        $this->assertJson($reponse);
    
    }

    
}
