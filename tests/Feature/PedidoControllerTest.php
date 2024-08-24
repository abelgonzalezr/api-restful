<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\tblcliente;
use App\Models\tblpedido;

class PedidoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_successful_response()
    {
        $response = $this->get('/api/pedidos');

        $response->assertStatus(200);
    }

    public function test_store_creates_new_pedido()
    {
        // Crear un cliente válido
        $cliente = tblcliente::factory()->create();

        $data = [
            'ClienteId' => $cliente->id,
            'fecha' => now()->toDateTimeString(),
            // otros campos necesarios para el pedido
        ];

        $response = $this->post('/api/pedidos', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tblpedidos', $data);
    }

    public function test_show_returns_pedido()
    {
        $pedido = tblpedido::factory()->create();

        $response = $this->get("/api/pedidos/{$pedido->PedidoId}");

        $response->assertStatus(200);
        $response->assertJson($pedido->toArray());
    }

    public function test_update_modifies_pedido()
    {
        $pedido = tblpedido::factory()->create();
        $newCliente = tblcliente::factory()->create();

        $data = [
            'ClienteId' => $newCliente->ClienteId,
            'fecha' => now()->subDays(5)->toDateTimeString(),
        ];

        $response = $this->put("/api/pedidos/{$pedido->PedidoId}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tblpedidos', $data);
    }

    public function test_destroy_deletes_pedido()
    {
        $pedido = tblpedido::factory()->create();

        $response = $this->delete("/api/pedidos/{$pedido->PedidoId}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('tblpedidos', ['PedidoId' => $pedido->PedidoId]);
    }
}