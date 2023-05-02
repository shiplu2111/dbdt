<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;
use App\Models\Stake;
use App\Models\Account;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class DailyQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:daily';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Respectively send an exclusive quote to everyone daily via email.';
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
     * @return int
     */
    public function handle()
    {
        $stakes = DB::table('stakes')
        ->whereDate('end_date', Carbon::now('Asia/Dhaka'))
        ->get();
        foreach($stakes as $item){

        $stack_method= DB::table('stake_methods')->where('id', $item->stake_method)->first();
            
                $account_data= DB::table('accounts')->where('user_id', $item->user_id)->first();
                $account_update = Account::find($account_data->id);
                $account_update->dbdt_balance = $account_data->dbdt_balance+$item->dbdt_amount+(($item->dbdt_amount*$stack_method->benifit*$stack_method->period)/1200);
                $account_update->withdraw_balance = $account_data->withdraw_balance+$item->dbdt_amount+(($item->dbdt_amount*$stack_method->benifit*$stack_method->period)/1200);
                $account_update->save();

                $a= Stake::find($item->id);
                $a->benifit=(($item->dbdt_amount*$stack_method->benifit*$stack_method->period)/1200);
                $a->status=2;
                $a->save();
       
        }
        
    }
}