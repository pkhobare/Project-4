<?php

class PhysicianController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
        $query  = Input::get('query');

		$docs = Physician::search($query);

		# Decide on output method...
		# Default - HTML
		
			return View::make('physician_index')
				->with('physicians', $docs)
                ->with('query', $query);
	}
    
    public function getIndexBySpeciality()
	{
        $index  = Input::get('query1');

		$docs = Physician::searchBySpeciality($index);
        $specialities = Physician::getSpecialities();
		# Decide on output method...
		# Default - HTML
		
			return View::make('physician_index')
				->with('physicians', $docs)
                ->with('query', $specialities[$index]);
	}
    
    public function postSearch()
	{
        if(Request::ajax()) {
            
            return View::make('hello');
            
			$query  = Input::get('query');
            dd($query);    
			# Do the actual query
	        $docs  = Physician::search($query);

	        $results = '';	        
            foreach($docs as $doc) {
                # Created a "stub" of a view called book_search_result.php; all it is is a stub of code to display a book
                # For each book, we'll add a new stub to the results
                $results .= View::make('physician_search_result')->with('physician', $doc)->render();   
            }

            # Return the HTML/View to JavaScript...
            return $results;
			
		}
	}
    
    

}