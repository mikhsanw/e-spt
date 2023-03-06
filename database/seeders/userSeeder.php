<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public $userpass='root';

    public function run()
    {
        $users = [
            [
                'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                'username'=>'root',
                'nama'=>'root',
                'password'=>bcrypt($this->userpass),
                'aksesgrup_id'=>1,
                'level'=>1,
                'email'=>'spbe@bengkaliskab.go.id',
                'email_verified_at'=>date("Y-m-d H:i:s"),
            ],[
                'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                'username'=>'kadis',
                'nama'=>'Kadis',
                'password'=>bcrypt("kadis123"),
                'aksesgrup_id'=>2,
                'level'=>2,
                'email'=>'kadis@bengkaliskab.go.id',
                'email_verified_at'=>date("Y-m-d H:i:s"),
            ],[
                'id'=>\Ramsey\Uuid\Uuid::uuid4()->toString(),
                'username'=>'admin',
                'nama'=>'Admin',
                'password'=>bcrypt("admin123"),
                'aksesgrup_id'=>3,
                'level'=>3,
                'email'=>'admin@bengkaliskab.go.id',
                'email_verified_at'=>date("Y-m-d H:i:s"),
            ]
        ];
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        foreach ($users as  $value) {
        DB::table('users')->insert($value);
        }
        Schema::enableForeignKeyConstraints();
    }
}
