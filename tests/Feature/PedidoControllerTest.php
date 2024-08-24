<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\tblcliente;
use App\Models\tblpedido;

class PedidoControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $cliente;

    protected function setUp(): void
    {
        parent::setUp();
        // Crear un cliente para usar en todas las pruebas
        $this->cliente = tblcliente::factory()->create();
    }

    public function test_index_returns_successful_response()
    {
        $response = $this->get('/api/pedidos');

        $response->assertStatus(200);
    }

    public function test_store_creates_new_pedido()
    {
        $data = [
            'ClienteId' => $this->cliente->ClienteId,
            'fecha' => now()->format('Y-m-d'),
            // otros campos necesarios para el pedido
        ];

        $response = $this->post('/api/pedidos', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tblpedido', $data);
    }

    public function test_show_returns_pedido()
    {
        $pedido = tblpedido::factory()->create([
            'ClienteId' => $this->cliente->ClienteId,
            'fecha' => now()->format('Y-m-d'),
        ]);

        $response = $this->get("/api/pedidos/{$pedido->PedidoId}");

        $response->assertStatus(200);
        $expectedJson = $pedido->toArray();
        $expectedJson['fecha'] = $pedido->fecha instanceof \DateTime ? $pedido->fecha->format('Y-m-d') : $pedido->fecha;
        $response->assertJson($expectedJson);
    }

    public function test_update_modifies_pedido()
    {
        $pedido = tblpedido::factory()->create([
            'ClienteId' => $this->cliente->ClienteId
        ]);

        $data = [
            'ClienteId' => $this->cliente->ClienteId,
            'fecha' => now()->subDays(5)->format('Y-m-d'),
        ];

        $response = $this->put("/api/pedidos/{$pedido->PedidoId}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tblpedido', $data);
    }

    public function test_destroy_deletes_pedido()
    {
        $pedido = tblpedido::factory()->create([
            'ClienteId' => $this->cliente->ClienteId
        ]);

        $response = $this->delete("/api/pedidos/{$pedido->PedidoId}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tblpedido', ['PedidoId' => $pedido->PedidoId]);
    }
}