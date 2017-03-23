<?php

use Sellout\Video;
use Sellout\Rating;
use Sellout\Category;
use Sellout\Hardware;
use Sellout\Catalog;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CatalogSeeder extends Seeder
{
    protected $video_definition = [
        'play_count' => 3,
        'play_duration' => 86400,
        'plays_unlimited' => true,
    ];
    protected $hardware_definition = [
        'foo' => 'bar',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->_seedVideo();
        $this->_seedHardware();
        $this->_seedCatalog();
    }
    private function _seedCatalog()
    {
        $catalogs = $this->_catalogs();
        foreach($catalogs as $c)
        {
            $id = $c['id'];
            Catalog::insert($c);
            $catalog = Catalog::find($id);
            $itemSlugs = $this->_items($catalog->slug);
            foreach($itemSlugs as $slug)
            {
                $item = $this->_findItem($slug);
                $definition = $this->_define($item);
                $item->catalogs()->attach($catalog, $definition);
            }
        }
    }
    private function _define($item)
    {
        $nest = new Sqlnest;
        if($item instanceof Video)
        {
            return ['definition' => $nest->toJson($this->video_definition)];
        }
        elseif($item instanceof Hardware)
        {
            return ['definition' => $nest->toJson($this->hardware_definition)];
        }
        return [];
    }
    private function _items($slug)
    {
        $items['megadeth-2016-bundle'] = [
            'megadeth_2016_the_threat_is_real',
            'megadeth_2016_post_american_world',
            'megadeth_2016_poisonous_shadows',
            'megadeth_2016_fatal_illusion',
            'megadeth_2016_dystopia',
            'megadeth_2016_look_whos_talking',
            'megadeth_2016_interview_with_blair_underwood',
        ];
        // $items['megadeth-2016-nogoggles'] = [
        //     'video-megadeth-01',
        //     'video-megadeth-02',
        //     'video-megadeth-03',
        //     'video-megadeth-04',
        //     'video-megadeth-05',
        // ];
        return $items[$slug];
    }
    private function _findItem($slug)
    {
        $item = false;
        $item = Video::where('slug', $slug)->first();
        if(is_null($item))
        {
            $item = Hardware::where('slug', $slug)->first();
        }
        return $item;
    }
    private function _catalogs()
    {
        $catalogs = [
            [
                'id' => 1,
                'mid' => 'Catalog-8e867501-b90b-463a-8a7f-18603e517566',
                'name' => 'Megadeth: Dystopia Bundle',
                'slug' => 'megadeth-2016-bundle',
                'cost' => 600,
                'ships' => false,
                'digital_only' => true,
            ],
            // [
            //     'name' => 'Megadeth 2016 Digital Package',
            //     'slug' => 'megadeth-2016-nogoggles',
            //     'cost' => 2000,
            //     'ships' => false,
            //     'digital_only' => true,
            // ],
        ];
        return $catalogs;
    }
    private function _seedHardware()
    {
        $hardwares = $this->_hardware();
        foreach($hardwares as $hardware)
        {
            Hardware::create($hardware);
        }
    }
    private function _seedVideo()
    {
        $videos = $this->_videos();
        foreach($videos as $video)
        {
            $category = $this->_category($video['category']);
            unset($video['category']);
            $id = $video['id'];
            Video::insert($video);
            $video = Video::find($id);
            $video->categories()->save($category);
        }
    }
    private function _hardware()
    {
        $hardware = [
            [
                'slug' => 'gearvr-1',
                'name' => 'GearVR Goggles',
                'color' => 'white',
            ],
            [
                'slug' => 'gearvr-2',
                'name' => 'GearVR Goggles',
                'color' => 'black'
            ],
            [
                'slug' => 'generic-vr',
                'name' => 'Generic VR Goggles',
                'color' => 'black',
            ],
        ];
        return $hardware;
    }
    private function _videos()
    {
        $videos = [
            // [
            //     'slug' => 'elephants-dream-2d',
            //     'format' => '2d',
            //     'name' => 'Elephants Dream',
            //     'show_time' => 'any',
            //     'url' => 'http://d3hdxkywnjxtng.cloudfront.net/3dvideos/transcoded/elephants_dreams_looped_1hr.m3u8',
            //     'rating_id' => $this->_rating('G'),
            //     'category' => 'Adventure',
            // ],
            // [
            //     'slug' => 'elephants-dream-3d',
            //     'format' => '3d',
            //     'name' => 'Elephants Dream',
            //     'show_time' => 'any',
            //     'url' => 'http://d3hdxkywnjxtng.cloudfront.net/3dvideos/transcoded/elephants_dreams3d_looped_1hr.m3u8',
            //     'rating_id' => $this->_rating('G'),
            //     'category' => 'Fantasy',
            // ],
            // [
            //     'slug' => 'ceek-360-demo',
            //     'format' => '360',
            //     'name' => 'Ceek Demo 360',
            //     'show_time' => 'any',
            //     'url' => 'http://d3hdxkywnjxtng.cloudfront.net/360videos/transcoded/Ceek_Test_Video.m3u8',
            //     'rating_id' => $this->_rating('PG-13'),
            //     'category' => 'Comedy',
            // ],
            [
                'id' => 2,
                'mid' => 'video-b92e5c08-82ef-44ab-b977-8c5b6e012f00',
                'slug' => 'megadeth_2016_the_threat_is_real',
                'format' => '360',
                'name' => 'The Threat Is Real',
                'show_time' => 'any',
                'url' => 'http://d3hdxkywnjxtng.cloudfront.net/360videos/transcoded/megadeth_2016_the_threat_is_real_v2.m3u8',
                'rating_id' => $this->_rating('PG-13'),
                'category' => 'Fantasy',
            ],
            [
                'id' => 3,
                'mid' => 'video-79c8643d-8291-40ed-8ed9-52e86dd289c1',
                'slug' => 'megadeth_2016_post_american_world',
                'format' => '360',
                'name' => 'Post American World',
                'show_time' => 'any',
                'url' => 'http://d3hdxkywnjxtng.cloudfront.net/360videos/transcoded/megadeth_2016_post_american_world_v2.m3u8',
                'rating_id' => $this->_rating('PG-13'),
                'category' => 'Fantasy',
            ],
            [
                'id' => 4,
                'mid' => 'video-f746bbb8-abaa-4d4a-883a-e982642da48c',
                'slug' => 'megadeth_2016_poisonous_shadows',
                'format' => '360',
                'name' => 'Poisonous Shadows',
                'show_time' => 'any',
                'url' => 'http://d3hdxkywnjxtng.cloudfront.net/360videos/transcoded/megadeth_2016_poisonous_shadows_v2.m3u8',
                'rating_id' => $this->_rating('PG-13'),
                'category' => 'Fantasy',
            ],
            [
                'id' => 5,
                'mid' => 'Video-d97f66fa-f280-4dbd-a584-2f9244123266',
                'slug' => 'megadeth_2016_fatal_illusion',
                'format' => '360',
                'name' => 'Fatal Illusion',
                'show_time' => 'any',
                'url' => 'http://d3hdxkywnjxtng.cloudfront.net/360videos/transcoded/megadeth_2016_fatal_illusion_v2.m3u8',
                'rating_id' => $this->_rating('PG-13'),
                'category' => 'Fantasy',
            ],
            [
                'id' => 6,
                'mid' => 'Video-421a16e7-e892-43d0-8c54-d91584d94be2',
                'slug' => 'megadeth_2016_dystopia',
                'format' => '360',
                'name' => 'Dystopia',
                'show_time' => 'any',
                'url' => 'http://d3hdxkywnjxtng.cloudfront.net/360videos/transcoded/megadeth_2016_dystopia_v2.m3u8',
                'rating_id' => $this->_rating('PG-13'),
                'category' => 'Fantasy',
            ],
            [
                'id' => 7,
                'mid' => 'Video-91b49b7b-7114-4d0a-99e8-5c04cec6ae6a',
                'slug' => 'megadeth_2016_look_whos_talking',
                'format' => '360',
                'name' => "Look Who's Talking",
                'show_time' => 'any',
                'url' => 'http://fake.url/changeme/megadeth_2016_look_whos_talking.m3u8',
                'rating_id' => $this->_rating('PG-13'),
                'category' => 'Fantasy',
            ],
            [
                'id' => 8,
                'mid' => 'Video-4cb68fe8-7aba-4432-a2c3-6e4598122125',
                'slug' => 'megadeth_2016_interview_with_blair_underwood',
                'format' => '360',
                'name' => 'Megadeth Interview With Blair Underwood',
                'show_time' => 'any',
                'url' => 'http://d3hdxkywnjxtng.cloudfront.net/360videos/transcoded/megadeth_2016_interview_with_blair_underwood_v2.m3u8',
                'rating_id' => $this->_rating('PG-13'),
                'category' => 'Fantasy',
            ],
        ];
        return $videos;
    }
    private function _hardwareSlug($slug)
    {
        return Hardware::where('slug', $slug)->get();
    }
    private function _videoSlug($slug)
    {
        return Video::where('slug', $slug)->get();
    }
    private function _category($category)
    {
        return Category::where('name', $category)->first();
    }
    private function _rating($rating)
    {
        return Rating::where('abbreviation', $rating)->first()->id;
    }
}
