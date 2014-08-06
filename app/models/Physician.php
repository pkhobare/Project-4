<?php

class Physician extends Eloquent { 

        public function hospitals() {
            # Physician belongs to many hospitals
            return $this->belongsToMany('Hospital');
        }
    
      public static function getSpecialities() {
          
          $specialities = Array();
          $physicians = Physician::all();
          $i = 1;
          foreach($physicians as $doc)
          {
              $specialities[$i] = $doc['speciality']; 
              $i++;
          }
          return $specialities;      
      }
    
    public static function search($query) {

        # If there is a query, search the library with that query
		if($query) {

			# Eager load tags and author
	 		$physicians = Physician::with('hospitals')
	 		->whereHas('hospitals', function($q) use($query) {
			    $q->where('name', 'LIKE', "%$query%");
			})
			->orWhere('speciality', 'LIKE', "%$query%")
			->get();
		}

		return $physicians;	
	}
    
    public static function searchBySpeciality($index) {

        # If there is a query, search the library with that query
		if($index) {

            # Identify speciality
            $specialities = Physician::getSpecialities();
            
            # Eager load tags and author
	 		$physicians = Physician::with('hospitals')->where('speciality', 'LIKE', "$specialities[$index]")->get();
		}

		return $physicians;	
	}
    
    
}

