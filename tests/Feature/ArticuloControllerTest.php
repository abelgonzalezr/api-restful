<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Factories\TblarticuloFactory;

class ArticuloControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_successful_response()
    {
        $response = $this->get('/api/articulos');

        $response->assertStatus(200);
    }

    public function test_store_creates_new_articulo()
    {
        $data = [
            'codigo_barras' => '1234567890123',
            'descripcion' => 'Descripción del artículo de prueba',
            'fabricante' => 'Fabricante de prueba',
        ];

        $response = $this->post('/api/articulos', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tblarticulos', $data);
    }

    public function test_show_returns_articulo()
    {
        $articulo = TblarticuloFactory::new()->create();

        $response = $this->get("/api/articulos/{$articulo->ArticuloId}");

        $response->assertStatus(200);
        $response->assertJson($articulo->toArray());
    }

    public function test_update_modifies_articulo()
    {
        $articulo = TblarticuloFactory::new()->create();

        $data = [
            'codigo_barras' => '9876543210987',
            'descripcion' => 'Descripción actualizada',
            'fabricante' => 'Fabricante actualizado',
        ];

        $response = $this->put("/api/articulos/{$articulo->ArticuloId}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tblarticulos', $data);
    }

    public function test_destroy_deletes_articulo()
    {
        $articulo = TblarticuloFactory::new()->create();

        $response = $this->delete("/api/articulos/{$articulo->ArticuloId}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('tblarticulos', ['ArticuloId' => $articulo->ArticuloId]);
    }
}