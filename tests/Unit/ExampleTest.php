<?php

namespace Tests\Unit;

use Exception;
use Illuminate\Support\Facades\Http;
use Jumbojett\OpenIDConnectClient;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    protected function setup(): void
    {
        parent::setUp();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }

    public function test_get_index()
    {
        $response = $this->get(route('test.index'));
        $response->assertStatus(200);
    }

    
}
