<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\tblcliente;
use Database\Factories\TblclienteFactory;

class ClienteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_successful_response()
    {
        $response = $this->get('/clientes');

        $response->assertStatus(200);
    }

    public function test_store_creates_new_cliente()
    {
        $data = [
            'nombre' => 'Juan Perez',
            'telefono' => '123456789',
            'tipo_cliente' => 'regular',
        ];

        $response = $this->post('/clientes', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tblclientes', $data);
    }

    public function test_show_returns_cliente()
    {
        $cliente = TblclienteFactory::new()->create();

        $response = $this->get("/clientes/{$cliente->ClienteId}");

        $response->assertStatus(200);
        $response->assertJson($cliente->toArray());
    }

    public function test_update_modifies_cliente()
    {
        $cliente = TblclienteFactory::new()->create();

        $data = [
            'nombre' => 'Juan Perez',
            'telefono' => '987654321',
            'tipo_cliente' => 'premium',
        ];

        $response = $this->put("/clientes/{$cliente->ClienteId}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tblclientes', $data);
    }

    public function test_destroy_deletes_cliente()
    {
        $cliente = TblclienteFactory::new()->create();

        $response = $this->delete("/clientes/{$cliente->ClienteId}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tblclientes', ['ClienteId' => $cliente->ClienteId]);
    }
}
