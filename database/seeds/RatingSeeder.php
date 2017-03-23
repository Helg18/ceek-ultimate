<?php

use Sellout\Rating;
use Sellout\RatingAgency;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agency = RatingAgency::create($this->_getAgency());
        $ratings = $this->_getRatings($agency->id);
        foreach($ratings as $rating)
        {
            Rating::create($rating);
        }
    }
    private function _getAgency()
    {
        return [
            'name' => 'Motion Picture Association of America',
            'abbreviation' => 'mpaa'
        ];
    }
    private function _getRatings($id)
    {
        return [
            [
                'abbreviation' => 'G',
                'age' => 0,
                'description' => 'Nothing that would offend parents for viewing by children.',
                'name' => 'General Audiences',
                'rating_agency_id' => $id
            ],
            [
                'abbreviation' => 'PG-13',
                'age' => 0,
                'description' => 'Some material may be inappropriate for children under 13. Parents are urged to be cautious. Some material may be inappropriate for pre-teenagers.',
                'name' => 'Parents Strongly Cautioned',
                'rating_agency_id' => $id
            ],
            [
                'abbreviation' => 'R',
                'age' => 0,
                'description' => 'Under 17 requires accompanying parent or adult guardian. Contains some adult material. Parents are urged to learn more about the film before taking their young children with them.',
                'name' => 'Restricted',
                'rating_agency_id' => $id
            ],
            [
                'abbreviation' => 'NC-17',
                'age' => 0,
                'description' => 'No One 17 and Under Admitted. Clearly adult. Children are not admitted.',
                'name' => 'Adults Only',
                'rating_agency_id' => $id
            ],
        ];
    }
}
