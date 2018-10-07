<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->json('GET', '/api/todo');
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => [['id', 'title', 'completed']]]);
    }

    public function testStore()
    {
        $title = "Welcome Test!";
        $response = $this->json('POST', '/api/todo', ['title' => $title]);
        $response->assertStatus(201);
        $response->assertJsonStructure(['data' => ['id', 'title', 'completed']]);
        $createdTask = $response->getData('data');
        $this->assertEquals($createdTask['data']['title'], $title);
    }

    public function testUpdate()
    {        
        $task = factory(\App\Task::class)->create();
        $showResponse = $this->json('GET', '/api/todo/'.$task->id);
        $updateResponse = $this->json('PUT', '/api/todo/'.$task->id, ['title' => $task->title, 'completed' => $task->completed]);
        $updateResponse->assertStatus(200);
        $updateResponse->assertJsonStructure(['data' => ['id', 'title', 'completed']]);
    }

    public function testShow()
    {
        $task = factory(\App\Task::class)->create();
        $response = $this->json('GET', '/api/todo/'.$task->id);
        $response->assertStatus(200);
        $response->assertJsonStructure(['data' => ['id', 'title', 'completed']]);
    }

    public function testDestroy()
    {
        $task = factory(\App\Task::class)->create();
        $response = $this->json('DELETE', '/api/todo/'.$task->id);
        $response->assertStatus(200);
    }
}
