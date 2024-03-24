<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;

class CreateEmployeeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'filament:create-employee';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '設定管理者後台';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        try {
            $account    = $this->ask('input account');
            $password   = $this->ask('input password');
            $name       = $this->ask('input name');
            $email      = $this->ask('input email');


            Employee::create([
                'account'   => $account,
                'password'  => bcrypt($password),
                'name'      => $name,
                'email'     => $email
            ]);

            $this->info('設定完畢！可以登入後台了');
        } catch (\Exception $e) {

        }
    }
}
