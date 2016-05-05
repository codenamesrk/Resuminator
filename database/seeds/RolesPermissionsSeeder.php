<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // App\Roles
		$user = new Role();
		$user->name         = 'user';
		$user->display_name = 'Project user'; // optional
		$user->description  = 'User is the user of a given project'; // optional
		$user->save();

		$editor = new Role();
		$editor->name         = 'editor';
		$editor->display_name = 'Resume Editor'; // optional
		$editor->description  = 'Editor is allowed to view and evaluate resumes'; // optional
		$editor->save(); 

		$admin = new Role();
		$admin->name         = 'admin';
		$admin->display_name = 'Administrator'; // optional
		$admin->description  = 'Admin is allowed to manage and edit other users'; // optional
		$admin->save();		

		// Permissions
		$postResume = new Permission();
		$postResume->name         = 'post-resume';
		$postResume->display_name = 'Post Resume'; // optional
		// Allow a user to...
		$postResume->description  = 'Post new Resume'; // optional
		$postResume->save();

		$viewResume = new Permission();
		$viewResume->name         = 'view-resume';
		$viewResume->display_name = 'View Resumes'; // optional
		// Allow a user to...
		$viewResume->description  = 'View Posted Resumes'; // optional
		$viewResume->save();

		$editResume = new Permission();
		$editResume->name         = 'edit-resume';
		$editResume->display_name = 'Edit Resumes'; // optional
		// Allow a user to...
		$editResume->description  = 'Edit Posted Resumes'; // optional
		$editResume->save();

		$addEditor = new Permission();
		$addEditor->name         = 'add-editor';
		$addEditor->display_name = 'Add Editor'; // optional
		// Allow a user to...
		$addEditor->description  = 'Add users who can edit resumes'; // optional
		$addEditor->save();	

		$user = App\User::first();
		$user->attachRole($admin);
								 
    }
}
