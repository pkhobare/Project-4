<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/seed-physician', function(){
    

//    $collection = Hospital::all();
//
//    # Clean db first before seeding
//    foreach($collection as $item) {
//        delete $item;
//    }    
    
//    $docs = Physician::all();
//
//    # Clean db first before seeding
//    foreach($docs as $doc) {
//        delete $doc;
//    }
    
    # Instantiate a new Hospital model class
    $hospital1 = new Hospital();

    # Set 
    $hospital1->name = 'Mass General';
    $hospital1->address = '55 Fruit St Boston, MA 02114';
    
    # This is where the Eloquent ORM magic happens
    $hospital1->save();
    
    
    $hospital2 = new Hospital();
    # Set 
    $hospital2->name = 'Beth Israel Deaconess Medical Center';
    $hospital2->address = '330 Brookline Ave Boston, MA 02215';
    
    # This is where the Eloquent ORM magic happens
    $hospital2->save();
    
    $hospital3 = new Hospital();
    # Set 
    $hospital3->name = 'Brigham & Women\'s Hospital';
    $hospital3->address = '75 Francis St Boston, MA 02115';
    
    # This is where the Eloquent ORM magic happens
    $hospital3->save();
    
    # Instantiate a new Book model class
    $doc1 = new Physician();

    # Set 
    $doc1->name = 'Pugh, Guy F.';
    $doc1->speciality = 'Internal Medicine';  
    # This is where the Eloquent ORM magic happens
    $doc1->save();
    
     $doc1->hospitals()->attach($hospital1);
     $doc1->hospitals()->attach($hospital3);
    
     $doc2 = new Physician();
    # Set 
    $doc2->name = 'Eliezer, Caren B.';
    $doc2->speciality = 'Dermatology';
    # This is where the Eloquent ORM magic happens
    $doc2->save();
    
    $doc2->hospitals()->attach($hospital2);
    $doc2->hospitals()->attach($hospital3);
    
    $doc3 = new Physician();
    # Set 
    $doc3->name = 'Munson, Dianne';
    $doc3->speciality = 'Gynecology';
    # This is where the Eloquent ORM magic happens
    $doc3->save();
    
    $doc3->hospitals()->attach($hospital1);
    $doc3->hospitals()->attach($hospital2);
    
    
    $doc4 = new Physician();
    # Set 
    $doc4->name = 'Angel, Andrew R., MD';
    $doc4->speciality = 'Medical Oncology';
    # This is where the Eloquent ORM magic happens
    $doc4->save();
    
    $doc4->hospitals()->attach($hospital3);
    

    return 'Database seeded! Check your database to see...';

});


Route::get('/practice-reading', function() {

    # The all() method will fetch all the rows from a Model/table
    $docs = Physician::all();

    # Typically we'd pass $books to a View, but for quick and dirty demonstration, let's just output here...
    # Eager load the tags with the books
    $physicians = Physician::with('hospitals')->get(); 

    foreach($physicians as $physician) {

        echo $physician->name."<br>";
        foreach($physician->hospitals as $hospital) {
        echo $hospital->name.", ";
        }

        echo "<br><br>";

    }

});

Route::get('/', function() {
    $specialities = Physician::getSpecialities();
    return View::make('search')->with('speciality', $specialities);
});
           
Route::get('/physician', 'PhysicianController@getIndex');
Route::get('/physician', 'PhysicianController@getIndexBySpeciality');

Route::get('/signup',
    array(
        'before' => 'guest',
        function() {
            return View::make('signup');
        }
    )
);

Route::post('/signup', 
    array(
        'before' => 'csrf', 
        function() {

            $user = new User;
            $user->email    = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->email    = Input::get('email');

            # Try to add the user 
            try {
                $user->save();
            }
            # Fail
            catch (Exception $e) {
                return Redirect::to('/signup')->with('flash_message', 'Sign up failed; please try again.')->withInput();
            }

            # Log the user in
            Auth::login($user);

            return Redirect::to('/list')->with('flash_message', 'Welcome to DocFinder!');

        }
    )
);

Route::get('/login',
    array(
        'before' => 'guest',
        function() {
            return View::make('login');
        }
    )
);

Route::post('/login', 
    array(
        'before' => 'csrf', 
        function() {

            $credentials = Input::only('email', 'password');

            if (Auth::attempt($credentials, $remember = true)) {
                return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
            }
            else {
                return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
            }

            return Redirect::to('login');
        }
    )
);

Route::get('/logout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/');

});

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});