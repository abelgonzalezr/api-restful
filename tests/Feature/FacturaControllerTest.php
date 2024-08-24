<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\tblpedido;
use App\Models\tblfactura;

class FacturaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $pedido;

    protected function setUp(): void
    {
        parent::setUp();
        // Crear un pedido para usar en todas las pruebas
        $this->pedido = tblpedido::factory()->create();
    }

    public function test_index_returns_successful_response()
    {
        $response = $this->get('/api/facturas');

        $response->assertStatus(200);
    }

    public function test_store_creates_new_factura()
    {
        $data = [
            'PedidoId' => $this->pedido->PedidoId,
            'monto_total' => 100.50,
            'fecha_emision' => now()->format('Y-m-d'),
        ];

        $response = $this->post('/api/facturas', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tblfactura', $data);
    }

    public function test_show_returns_factura()
    {
        $factura = tblfactura::factory()->create([
            'PedidoId' => $this->pedido->PedidoId,
        ]);

        $response = $this->get("/api/facturas/{$factura->FacturaId}");

        $response->assertStatus(200);
        $expectedJson = $factura->toArray();
        $expectedJson['fecha_emision'] = $factura->fecha_emision instanceof \DateTime ? $factura->fecha_emision->format('Y-m-d') : $factura->fecha_emision;
        $response->assertJson($expectedJson);
    }

    public function test_update_modifies_factura()
    {
        $factura = tblfactura::factory()->create([
            'PedidoId' => $this->pedido->PedidoId
        ]);

        $data = [
            'PedidoId' => $this->pedido->PedidoId,
            'monto_total' => 200.75,
            'fecha_emision' => now()->subDays(5)->format('Y-m-d'),
        ];

        $response = $this->put("/api/facturas/{$factura->FacturaId}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tblfactura', $data);
    }

    public function test_destroy_deletes_factura()
    {
        $factura = tblfactura::factory()->create([
            'PedidoId' => $this->pedido->PedidoId
        ]);

        $response = $this->delete("/api/facturas/{$factura->FacturaId}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tblfactura', ['FacturaId' => $factura->FacturaId]);
    }
}

