<?php

namespace Database\Seeders;

use App\Models\ChatRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chatRequestFactory = ChatRequest::factory();
        $chatRequestFactory->create();
    }
}
