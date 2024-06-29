<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Property;
use App\Models\PropertyGeo;
use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(resource_path() . '/js/properties.json');
        $properties = json_decode($json);
        foreach ($properties as $key => $value) {
            $geo = $value->geo;
            // create country 
            $countryProvince = Str::slug($geo->country, '-');
            $country = Country::where('slug', $countryProvince)->where('currency', $value->currency)->first();
            if (empty($country)) {
                $country = new Country();
                $country->name = $geo->country;
                $country->slug = $countryProvince;
                $country->currency = $value->currency;
                $country->currency_symbol = $value->currency_symbol;
                $country->save();
            }
            // create province
            $provinceSlug = Str::slug($geo->province, '-');
            $province = Province::where('slug', $provinceSlug)->where('country_id', $country->id)->first();
            if (empty($province)) {
                $province = new Province();
                $province->country_id = $country->id;
                $province->name = $geo->province;
                $province->slug = $provinceSlug;
                $province->save();
            }

            // create property
            $property = new Property();
            $property->title = $value->title;
            $property->description = $value->description;
            $property->for_sale = $value->for_sale;
            $property->for_rent = $value->for_rent;
            $property->sold = $value->sold;
            $property->price = $value->price;
            $property->property_type = array_search($value->property_type, config('property_type'));
            $property->bedrooms = $value->bedrooms;
            $property->bathrooms = $value->bathrooms;
            $property->area = $value->area;
            $property->area_type = array_search($value->area_type, config('property_type'));
            $property->save();

            // create property geo
            $propertyGeo = new PropertyGeo();
            $propertyGeo->property_id = $property->id;
            $propertyGeo->country_id = $country->id;
            $propertyGeo->province_id = $province->id;
            $propertyGeo->street = $geo->street;
            $propertyGeo->save();
        }
    }
}
