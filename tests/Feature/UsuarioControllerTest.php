<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Database\Factories\tblPY1Factory;

class UsuarioControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_successful_response()
    {
        $response = $this->get('/api/usuarios');

        $response->assertStatus(200);
    }

    public function test_store_creates_new_usuario()
    {
        $data = [
            'username' => 'testuser',
            'password' => 'password123',
            'cedula' => '1234567890',
            'telefono' => '0987654321',
            'tipo_sangre' => 'A+',
        ];

        $response = $this->post('/api/usuarios', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tblPY1', [
            'username' => 'testuser',
            'cedula' => '1234567890',
            'telefono' => '0987654321',
            'tipo_sangre' => 'A+',
        ]);
    }

    public function test_show_returns_usuario()
    {
        $usuario = tblPY1Factory::new()->create();

        $response = $this->get("/api/usuarios/{$usuario->UserId}");

        $response->assertStatus(200);
        $response->assertJson($usuario->toArray());
    }

    public function test_update_modifies_usuario()
    {
        $usuario = tblPY1Factory::new()->create();

        $data = [
            'username' => 'updateduser',
            'telefono' => '9876543210',
            'tipo_sangre' => 'B-',
        ];

        $response = $this->put("/api/usuarios/{$usuario->UserId}", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tblPY1', $data);
    }

    public function test_destroy_deletes_usuario()
    {
        $usuario = tblPY1Factory::new()->create();

        $response = $this->delete("/api/usuarios/{$usuario->UserId}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('tblPY1', ['UserId' => $usuario->UserId]);
    }
}
