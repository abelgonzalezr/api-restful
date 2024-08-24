<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Factories\TblclienteFactory;

class ClienteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_successful_response()
    {
        $response = $this->get('/api/clientes');

        $response->assertStatus(200);
    }

    public function test_store_creates_new_cliente()
    {
        $data = [
            'nombre' => 'abel',
            'telefono' => '8293798435',
            'tipo_cliente' => 'nuevo',
        ];

        $response = $this->post('/api/clientes', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tblclientes', $data);
    }

    public function test_show_returns_cliente()
    {
        $cliente = TblclienteFactory::new()->create();

        $response = $this->get("/api/clientes/{$cliente->ClienteId}");

        $response->assertStatus(200);
        $response->assertJson($cliente->toArray());
    }

    public function test_update_modifies_cliente()
    {
        $cliente = TblclienteFactory::new()->create();

        $data = [
            'nombre' => 'updated name',
            'telefono' => '8293798436',
            'tipo_cliente' => 'vip',
        ];

        $response = $this->put("/api/clientes/{$cliente->ClienteId}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tblclientes', $data);
    }

    public function test_destroy_deletes_cliente()
    {
        $cliente = TblclienteFactory::new()->create();

        $response = $this->delete("/api/clientes/{$cliente->ClienteId}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tblclientes', ['ClienteId' => $cliente->ClienteId]);
    }
}