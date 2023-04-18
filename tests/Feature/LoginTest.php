<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    use RefreshDatabase; // Este trait permite resetear la base de datos después de cada prueba

    /** @test */
    public function un_usuario_puede_iniciar_sesion_con_credenciales_validas()
    {
        // Crear un usuario de prueba en la base de datos
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Visitar la página de inicio de sesión
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Verificar que el usuario se haya autenticado correctamente
        $response->assertRedirect('/home'); // Verificar que el usuario fue redireccionado a la página de inicio
        $this->assertAuthenticatedAs($user); // Verificar que el usuario esté autenticado en la aplicación
    }

    /** @test */
    public function un_usuario_no_puede_iniciar_sesion_con_credenciales_invalidas()
    {
        // Visitar la página de inicio de sesión con credenciales inválidas
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        // Verificar que el usuario no se haya autenticado correctamente
        $response->assertSessionHasErrors('email'); // Verificar que se haya mostrado un error en la sesión
        $this->assertGuest(); // Verificar que el usuario no esté autenticado en la aplicación
    }
}
