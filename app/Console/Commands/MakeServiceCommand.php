<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceCommand extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Tạo một Service mới trong thư mục app/Services';

    public function handle()
    {
        $name = $this->argument('name');
        $servicePath = app_path("Services/{$name}.php");

        if (File::exists($servicePath)) {
            $this->error("Service {$name} đã tồn tại!");
            return;
        }

        File::ensureDirectoryExists(app_path('Services'));

        $content = <<<EOT
        <?php

        namespace App\Services;

        class {$name}
        {
            //
        }
        EOT;

        File::put($servicePath, $content);
        $this->info("Service {$name} đã được tạo thành công!");
    }
}
