<?php 

namespace App\Libraries;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Process;

class Prince
{
    private $prince;
    private $options;
    private $filename;
    private $filepath;

    /**
     * Create a new Prince instance.
     * 
     * @param   string $title
     * @return  void
     */
    function __construct($title)
    {
        if (!is_file(env('PRINCE_EXECUTABLE_PATH'))) {
            throw new Exception('Prince could not be found at ' . env('PRINCE_EXECUTABLE_PATH'));
        }

        if (!is_executable(env('PRINCE_EXECUTABLE_PATH'))) {
            throw new Exception('Prince does not have execute permissions');
        }

        $this->prince   = env('PRINCE_EXECUTABLE_PATH');
        $this->options  = '--input=html --pdf-author="'. config('app.owner', 'Yoel Diomedez Apps') .'" --pdf-title="' . $title . '"';
        $this->filename = time() . '_' . bin2hex(random_bytes(20));
        $this->filepath = Storage::disk(config('app.disk'))->getConfig()['root'] . '/' . $this->filename;
        
        if (env('APP_DEBUG')) {
            Log::debug('*****  New Prince instance *****');
            Log::debug('$this->prince   : ' . $this->prince );
            Log::debug('$this->options  : ' . $this->options);
            Log::debug('$this->filename : ' . $this->filename);
            Log::debug('$this->filepath : ' . $this->filepath);
            Log::debug('********************************');
        }

    }

    /**
     * Convert HTML documents to PDF.
     * 
     * @param   string $html
     * @return  string $pdf 
     */
    public function generate($html)
    {
        $pdf     = null;
        $cmd     = sprintf('%1$s %2$s %3$s --output %3$s.pdf', $this->prince, $this->options, $this->filepath);
        $storage = Storage::disk(config('app.disk'))->put($this->filename, $html);
        $process = Process::run($cmd);

        if (Storage::disk(config('app.disk'))->exists($this->filename . '.pdf')) {
             $pdf = $this->filepath . '.pdf';  
        }

        if (env('APP_DEBUG')) {
            Log::debug('***** Prince generate method *****');
            Log::debug('$cmd     : ' . $cmd);
            Log::debug('$storage : ' . $storage);
            Log::debug('$process->successful()  : ' . $process->successful());
            Log::debug('$process->failed()      : ' . $process->failed());
            Log::debug('$process->exitCode()    : ' . $process->exitCode());
            Log::debug('$process->output()      : ' . $process->output());
            Log::debug('$process->errorOutput() : ' . $process->errorOutput());
            Log::debug('$pdf     : ' . $pdf);
            Log::debug('**********************************');
        }

        return $pdf;
    }
}