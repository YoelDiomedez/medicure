<?php 

namespace App\Libraries;

use Illuminate\Support\Facades\Storage;

class Prince
{
    private $prince;
    private $storage;
    private $options;

    function __construct($title)
    {
        $this->prince = env('PRINCE_EXECUTABLE_PATH');

        if (!is_file($this->prince)) {
            throw new Exception('Prince could not be found at ' . env('PRINCE_EXECUTABLE_PATH'));
        }
        if (!is_executable($this->prince)) {
            throw new Exception('Prince does not have execute permissions');
        }

        $this->storage = Storage::disk(config('app.disk'))->getConfig()['root'];
        $this->options = '--input=html --pdf-author="'. config('app.owner', 'Yoel Diomedez Apps') .'" --pdf-title="' . $title . '"';
    }

    public function generate($html)
    {
        $filename = time() . '_' . bin2hex(random_bytes(20));

        Storage::disk(config('app.disk'))->put($filename, $html);

        $filepath = $this->storage . '/' . $filename;
        
        exec(sprintf('%1$s %2$s %3$s --output %3$s.pdf', $this->prince, $this->options, $filepath));
        
        if (Storage::disk(config('app.disk'))->exists($filename . '.pdf')) {
            header('Content-type:application/pdf');
            header('Content-Disposition:inline;filename=reporte.pdf');
            header('Content-Length: ' . filesize($filepath . '.pdf'));
            readfile($filepath . '.pdf');
        }
    }
}