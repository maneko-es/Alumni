<?php

namespace App\Http\Controllers\Admin;

use App\School;
use App\User;
use App\Registry;
use App\Promotion;

class MailingController extends AdminController
{

    public function __construct()
    {
        
    }

    public function contact()
    {
        $form = array(
            'name' => 'Eudald Boronat Cadí',
            'email' => 'eboronat@gmail.com',
            'message' => 'Praesent ultrices metus vestibulum, pretium nisi in, vulputate purus. Praesent convallis ultrices nisl, fringilla dictum felis interdum vel. Vestibulum augue nisi, vehicula eu elementum quis, cursus a eros. Duis posuere vitae augue quis pulvinar. Nullam maximus vel nulla a rutrum. Morbi eget libero tempor, posuere diam eu, vehicula ante. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse mi sem, consectetur volutpat ipsum elementum, interdum posuere eros.  Sed semper nunc urna, at pellentesque arcu euismod cursus. Etiam id blandit tellus. In suscipit libero sed massa elementum, blandit elementum elit ultricies. Morbi ullamcorper augue sed sem accumsan, ut placerat dui gravida. Nunc ac vulputate neque, et eleifend metus. Mauris scelerisque tincidunt auctor. Vestibulum id metus lobortis, sodales massa sed, lacinia augue. Praesent pellentesque velit eget dignissim tincidunt. Donec non fermentum mi. Nulla eget nulla finibus, gravida orci varius, bibendum augue. Nunc lectus dolor, ornare eu eros eget, malesuada mollis magna.'
        );
        $school = School::find(1);
        return view('emails.contact',compact('form','school'));
    }

    public function registry()
    {
        $registry = Registry::orderBy('created_at','desc')->first();
        $school = School::find(1);
        $promotion = Promotion::orderBy('created_at','desc')->first();

        return view('emails.registry',compact('registry','school','promotion'));
    }

    public function userAccepted()
    {
        $user = User::orderBy('created_at','desc')->first();
        $school = School::find(1);
        $password = 'password';

        return view('emails.user-accepted',compact('user','password','school'));
    }

    public function userDenied()
    {
        $school = School::find(1);

        return view('emails.user-denied',compact('school'));
    }

    
}
