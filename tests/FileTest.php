<?php

class FileTest extends BrowserKitTestCase
{
    protected $userManager;

    public function __construct()
    {
    }

    public function testCreateFile()
    {
        $filesSystem = \App::make(\STS\Contracts\Repository\Files::class);

        $path = base_path('tests/test_file.txt', 'image');
        File::put($path, 'HOLA');

        $name = $filesSystem->createFromFile($path);

        $true = File::exists(public_path('image/'.$name));
        $this->assertTrue($true);

        File::delete(public_path('image/'.$name));
    }
}
