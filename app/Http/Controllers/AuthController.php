<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role; 
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Generator;

class AuthController extends Controller
{
     public function register(Request $req)
     {
          $this->validate($req, [
               'name' => 'required|max:30',
               'email' => 'required|unique:users|max:50',
               'password' => 'required|min:6',
               'role_id' => 'required',
               'phone' => 'required'
          ]);
          $password = $req->password;
          $hashPwd = Hash::make($password);
          $api_token = generateRandomString();
          $data = User::create([
               'name' => $req->input('name'),
               'email' => $req->input('email'),
               'password' => $hashPwd,
               'role_id' => $req->input('role_id'),
               'phone' => $req->input('phone'),
               'photo' => 'default.jpg',
               'isAdmin' => 1,
               'api_token' => $api_token
          ]);
          if ($data) {
               // $to_name = $req->input('name');
               // $to_email = $req->input('email');
               // $data = array('name' => $to_name, "body" => "A test mail");
               // Mail::send('emails.mail1', $data, function ($message) use ($to_name, $to_email) {
               //      $message->to($to_email, $to_name)->subject('Registration Succesfuly');
               //      $message->from('adehikmat.rpl2.smkn1kawali@gmail.com', 'Wedding');
               // });
               return response(costumResponse("success", $data, 200, 1));
          } else {
               return response(costumResponse("failed", "internal server error", 500, 0));
          }
     }
     public function login(Request $req)
     {
          $this->validate($req, [
               'email' => 'required|email|max:30',
               'password' => 'required|min:6',
          ]);
          $email = $req->input("email");
          $password = $req->input("password");

          $user = User::where("email", $email)->first();
          if (!$user) {
               return response(costumResponse("failed", "wrong email", 401, 0));
          }
          if (!Hash::check($password, $user->password)) {
               return response(costumResponse("failed", "wrong password", 401, 0));
          }
          $newtoken  = generateRandomString();
          $user->update([
               'token' => $newtoken
          ]);
          return response(costumResponse("success", $user, 200, 1));
     }
     public function user()
     {
          $user = User::with(['userRole'])->get();
          return response(costumResponse("success", $user, 200, 1));
     }
     public function test()
     {
          // $sms = sendWa("WA BOOT", '0881023365227');
          // return $sms;
          // $qrcode = new Generator;
          // return $qrcode->size(500)->format('svg')->generate('Make a qrcode without Laravel!','QrCode/1.svg');
          
     }
}
