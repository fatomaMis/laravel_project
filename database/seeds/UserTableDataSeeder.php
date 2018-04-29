<?php



use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; 
use App\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = [
    		['name'=>'Admin', 'email'=>'admin@admin.com','password'=>bcrypt('123456')]
    	];


    	foreach ($users as $key => $value) {
        	User::create($value);
    	}
    }
}
