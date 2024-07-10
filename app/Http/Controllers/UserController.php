<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
     public function store(Request $request)
     {
          $formFields = $request->validate([
               'name' => ['required', 'min:3'],
               'email' => ['required', 'email', Rule::unique('users', 'email')],
               'password' => 'required|confirmed|min:6',
               'role' => ['required', Rule::in(['A', 'S'])]
          ], [
               'name.required' => 'Le champ nom est obligatoire.',
               'name.min' => 'Le nom doit contenir au moins 3 caractères.',
               'email.required' => 'Le champ email est obligatoire.',
               'email.email' => 'Vous devez entrer une adresse email valide.',
               'email.unique' => 'Cette adresse email est déjà utilisée.',
               'password.required' => 'Le champ mot de passe est obligatoire.',
               'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
               'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
               'role.required' => 'Le champ rôle est obligatoire.',
               'role.in' => 'Le rôle sélectionné n\'est pas valide.'
          ]);
          //hash password
          $formFields['password'] = bcrypt(($formFields['password']));

          $user = User::create($formFields);
          return redirect()->back()->with('success', "le compt de ". $user->name ." est bien crée " );
     }
     function register()
     {
          if (auth()->user()->role == 'S') {
            return view('user.registre');
          }
          return abort(403, 'you are not a super admin');
     }
     function list()
     {
          if (auth()->user()->role == 'S') {
               $admin = User::where('id', '!=', auth()->id())->get();
               return view('user.listAdmin', ['admins' => $admin]);
          }
          return abort(403, 'you are not a super admin');
     }
     function modif(User $user)
     {
          if (auth()->user()->role == 'S') {
               return view('user.updateAdmin', ['user' => $user]);
          }
          return abort(403, 'you are not a super admin');
     }
     function modif_info(Request $request,User $user)
     {
          if (auth()->user()->role == 'S') {
               $formFields = $request->validate([
                    'name' => ['required', 'min:3'],
                    // 'email' => ['required', 'email', Rule::unique('users', 'email')],
                    'email' => 'required|email|unique:users,email,' . $user->id,
                    'role' => 'required'
               ], [
                    'name.required' => 'Le nom est obligatoire.',
                    'name.min' => 'Le nom doit contenir au moins 3 caractères.',
                    'email.required' => 'L\'email est obligatoire.',
                    'email.email' => 'L\'email doit être une adresse email valide.',
                    'email.unique' => 'Cet email est déjà utilisé par un autre utilisateur.',
                    'role.required' => 'L\'email est obligatoire.',
               ]);
     
               $user->update($formFields);
               return redirect()->back()->with('success', 'Your profile has been updated!');
          }
          return abort(403, 'you are not a super admin');
     }
     function modif_password(Request $request,User $user)
     {
               if (auth()->user()->role == 'S') {
               $request->validateWithBag('userDeletion', [
                    'current_password' => ['required', 'current_password'],
                ]);
               $formFields = $request->validate([
                    'password' => 'nullable|confirmed|min:6'
               ], [
                    'password.confirmed' => 'Les mots de passe ne correspondent pas.',
               'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.'
               ]);
               $formFields['password'] = bcrypt(($formFields['password']));
               $user->update($formFields);
               return redirect()->back()->with('success', 'Your password has been updated!');
          }
          return abort(403, 'you are not a super admin');
     }

     function delete(Request $request)
     { 
          $request->validateWithBag('userDeletion', [
               'current_password' => ['required', 'current_password'],
           ]);
        if (auth()->user()->role == 'S') {
            $user=User::find($request->id);
            $user->delete();
            return redirect()->back()->with('success','user deleted seccessfuly');
       }
       return abort(403, 'you are not a super admin');
             
     }
}
