<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DashboardMail;
use Illuminate\Support\Facades\File;

use App\Models\Order;

class SendMyMarketsEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is for send to markiting emails';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $contents = File::get(storage_path('app/emailsMarketing/emails.txt'));
        $emails = explode(',', $contents);
        
    //    dd($array);
        
            



        foreach ($emails as $email) {
            Mail::to($email)->queue(new DashboardMail(
                ('لو انت صاحب مهنة او مقدم خدمات او صاحب مشروع موقع ' . config('app.name') . ' هايوصلك بالعملاء القريبين منك بكل سهولة  وتقدر تتابع حجوزاتك واحصائياتك مجانا.
                بمناسبة افتتاح الموقع
                التسجيل مجاني لاول 1000 مشترك   ... سارع الان 👍'),
                null
            ));
        }

        //ok
    }
}
