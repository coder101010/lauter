<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\App;

use Illuminate\Http\Request;
use App\Models\Messages;


class HourlyUpdate extends Command
{
   /**
    * The name and signature of the console command.
    *
    * @var string
    */
   protected $signature = 'hour:update';
   /**
    * The console command description.
    *
    * @var string
    */
   protected $description = 'Keep the feed tidy!';
   /**
    * Create a new command instance.
    *
    * @return void
    */
   public function __construct()
   {
       parent::__construct();
   }
   /**
    * Execute the console command.
    *
    * @return mixed
    */
   public function handle()
   {

    $count = Messages::count();

    $deleteUs = Messages::latest()->take($count)->skip(env('MSG_HISTORY'))->get();

    $textCount = 0;
    $assetCount = 0;

    foreach($deleteUs as $deleteMe){
        
        if ( $deleteMe->attachment ) {

            $originalPath = $deleteMe->attachment;
            $strstrPath = strstr($originalPath, 'images/');
            Storage::disk('s3')->delete($strstrPath); 
    
            $assetCount++;
        }
        
        Messages::where('id',$deleteMe->id)->delete();
    
        $textCount++;
    
    }       

    Log::info('Total of '.$textCount.' message(s) was deleted, along with '.$assetCount.' asset(s).');

    $this->info('List has been refreshed!');

   }
}