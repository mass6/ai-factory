<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use OpenAI\Laravel\Facades\OpenAI;

class CreateImageVariationCommand extends Command
{
    protected $signature = 'image:variation';

    protected $description = 'Command description';

    public function handle()
    {
        $file = fopen(__DIR__ .'/../../../storage/app/public/img.png', 'r');

        $response = OpenAI::images()->variation([
            'image' => $file,
            'size' => '1024x1024',
            'n' => 5,
        ]);

        $imageUrls = collect($response->data)->map(fn ($item) => $item->url)->toArray();
        logger()->info('image variations', ['urls' => $imageUrls]);

        $this->info('Complete');
        $this->line('');
        collect($imageUrls)->each(function ($url) {
            $this->info($url);
            $this->line('');
        });
    }
}
