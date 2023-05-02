<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_upload_file(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Storage::fake('files');

        $file = UploadedFile::fake()->create('import.xlsx');

        $this->post('upload/exel', [
            'file' => $file,
        ]);

        Storage::disk('files')->assertMissing('import.xlsx');
    }
}
