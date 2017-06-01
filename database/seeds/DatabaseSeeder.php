<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Curso;
use App\Estudiante;
use App\Profesor;



class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('set foreign_key_checks = 0');
		Estudiante::truncate();
		Profesor::truncate();
		Curso::truncate()
		DB::table('curso_estudiante')->truncate();
		Model::unguard();

		$this->call('UserTableSeeder');
		factory(Profesor::class, 50)->create();
		factory(Estudiante::class, 500)->create();
		factory(Curso::class, 40)->create(['profesor_id'=> mt_rand(1, 50)])->each(function($curso){
					$curso->estudiantes()->attach(array_rand(range(1, 500),40));
				});

	}

}
