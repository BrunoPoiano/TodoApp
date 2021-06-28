<?php

namespace Tests\Feature;

use App\Models\Todo\Afazer;
use Tests\TestCase;

class TodoappTest extends TestCase
{
    //use RefreshDatabase;

    public function testStore()
    {
        $data = [
            'prioridade' => 1,
            'afazer' => 'teste-PHPUnit',
        ];

        $this->post('todo/store', $data)
            ->assertStatus(200);
    }

    public function testUpdate()
    {
        $afazer = Afazer::factory()->create();
        $this->put("todo/update/" . $afazer->id)
            ->assertStatus(200);
    }

    public function testDelete()
    {
        $afazer = Afazer::factory()->create();
        $this->delete("todo/delete/" . $afazer->id)
            ->assertStatus(200);
    }

    public function testGetPrioridades()
    {
        $this->get('todo/getprioridades')
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'nome', 'created_at', 'updated_at'],
            ]);
    }

    public function testGetAfazeres()
    {
        $this->get('todo/getafazeres')
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'afazer', 'finalizado', 'prioridade', 'nome', 'created_at', 'updated_at'],
            ]);
    }

    public function testGetAfazeresFinalizados()
    {
        $this->get('todo/getafazeresfinalizados')
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'afazer', 'finalizado', 'prioridade', 'nome', 'created_at', 'updated_at'],
            ]);
    }

}
