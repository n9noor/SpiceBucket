<?php
namespace App\Jobs;
use Illuminate\Bus\Queueable;

use Illuminate\Queue\SerializesModels; 
use Illuminate\Queue\InteractsWithQueue; 
use Illuminate\Contracts\Queue\ShouldQueue; 
use Illuminate\Foundation\Bus\Dispatchable; 
 
use App\Traits\CommonTrait;


class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, CommonTrait;
    
    protected $order_id;
    protected $customerEmail;
    
    
    /** 
    * Create a new job instance.
    * @return void
    */ 
    
    public function __construct($order_id,$customerEmail)
    {
    $this->order_id = $order_id;
    $this->customerEmail = $customerEmail;
    }
    
    /** 
    * Execute the job.
    *
    * @return void
    */
    
    public function handle()
    {
         $this->sendMailForOrderTrait( $this->order_id,$this->customerEmail);
    
    }
}
