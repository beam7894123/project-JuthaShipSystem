<?php

namespace Database\Factories;

use App\Models\Journey;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//        $status = array('PENDING','APPROVED');
        $imagePath = array(
            '/images/document/defaultDocument.png',
            '/images/document/fired-from-dominos.jpg',
            '/images/document/JUTHA.jpg',
            '/images/document/Surveys_for_Freeboard_(Computation_for_Steamer,_Sailing_Ship,_Tanker)_Report_for_James_Lamont,_Undated_Page_1_Image_0001.jpg',
            '/images/document/Surveys_for_Freeboard_(Computation_for_Steamer,_Sailing_Ship,_Tanker)_Report_for_James_Lamont,_Undated_Page_2_Image_0001.jpg',
            '/images/document/k1nfgkiz5qza1.png'
        );

        return [
            'imagePath' => $imagePath[array_rand($imagePath)],
            'journey_id' => Journey::find(rand(1,10)),
//            'status' => $status[array_rand($status)],
        ];
    }
}
