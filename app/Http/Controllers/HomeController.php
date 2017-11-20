<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Hash;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    private $serviceAccount, $firebase, $database, $reference;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/firebase_credentials.json');
        $this->firebase = (new Factory)
            ->withServiceAccount($this->serviceAccount)
            ->create();

        $this->database = $this->firebase->getDatabase();

        $this->reference = $this->database->getReference('venues');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function showVenues(Request $request)
    {

        $snapshot = $this->reference->getSnapshot();

        $value = $snapshot->getValue();
        $venues = collect($value);

        $users = User::all();

        return view('pages.venues', [
            'venues' => $venues,
            'users' => $users,
        ]);

    }

    public function showAddVenue(Request $request)
    {
        $key = $this->generateRandomString(16);
        return view('pages.add_venue', [
            'key' => $key
        ]);
    }

    public function showEditVenue(Request $request, $id)
    {
        $reference = $this->database->getReference('/venues/' . $id);
        $snapshot = $reference->getSnapshot();

        $value = $snapshot->getValue();

        if (empty($value)) {
            return "<h2>Oops! No entry found.</h2>";
        }

        $venue = collect($value);

        if (empty($venue['id'])) {
            return "<h2>Oops! Error parsing this entry.</h2>";
        }

        if (!empty($venue['photos'])) {
            $photo_urls_base64 = '';
            foreach ($venue['photos'] as $key => $url) {
                if ($photo_urls_base64 == '') {
                    $photo_urls_base64 = base64_encode($url);
                } else {
                    $photo_urls_base64 = $photo_urls_base64 . "," . base64_encode($url);
                }
            }
        } else {
            $photo_urls_base64 = '';
        }

        return view('pages.edit_venue', [
            'venue' => $venue,
            'key' => $venue['id'],
            'photo_urls' => $photo_urls_base64,
        ]);
    }

    public function addVenue(Request $request)
    {
        $key = $request->input('key');

        if ($request->has('confirm')) {
            $confirm = $request->input('confirm');
        } else {
            $confirm = false;
        }

        if ($request->has('name')) {
            $name = $request->input('name');
        } else {
            $name = 'no name';
        }

        if ($request->has('address')) {
            $address = $request->input('address');
        } else {
            $address = 'no address';
        }

        if ($request->has('lat')) {
            $latitude = $request->input('lat');
        } else {
            $latitude = 0;
        }

        if ($request->has('lng')) {
            $longitude = $request->input('lng');
        } else {
            $longitude = 0;
        }

        if ($request->has('description')) {
            $description = $request->input('description');
        } else {
            $description = '';
        }

        if ($request->has('membershipDetail')) {
            $membershipDetail = $request->input('membershipDetail');
        } else {
            $membershipDetail = '';
        }

        if ($request->has('public')) {
            $public = $request->input('public');


            if ($public == true)
                $isPrivate = false;
            else
                $isPrivate = true;
        } else {
            $isPrivate = true;
        }

        if ($request->has('airbnb')) {
            $airbnb = $request->input('airbnb');
        } else {
            $airbnb = '';
        }

        $num_of_seats = $request->input('num_of_seats');
        $type = $request->input('type');
        $estateType = $request->input('estateType');

        if ($request->has('phone')) {
            $phone = $request->input('phone');
        } else {
            $phone = '';
        }

        if ($request->has('weblink')) {
            $weblink = $request->input('weblink');
        } else {
            $weblink = '';
        }

        if ($request->has('outdoor')) {
            $outdoor = $request->input('outdoor');
        } else {
            $outdoor = false;
        }

        if ($request->has('wifi')) {
            $wifi = $request->input('wifi');
        } else {
            $wifi = false;
        }


        // open hours
        $open_hours = [];

        if ($request->has('Monday_open')) {
            $monday_open = $request->input('Monday_open');

            if ($monday_open != '---') {
                $open_hours['monday'] = $monday_open;
            }
        }

        if ($request->has('Tuesday_open')) {
            $tuesday_open = $request->input('Tuesday_open');

            if ($tuesday_open != '---') {
                $open_hours['tuesday'] = $tuesday_open;
            }
        }

        if ($request->has('Wednesday_open')) {
            $wednesday_open = $request->input('Wednesday_open');

            if ($wednesday_open != '---') {
                $open_hours['wednesday'] = $wednesday_open;
            }
        }

        if ($request->has('Thursday_open')) {
            $thursday_open = $request->input('Thursday_open');

            if ($thursday_open != '---') {
                $open_hours['thursday'] = $thursday_open;
            }
        }

        if ($request->has('Friday_open')) {
            $friday_open = $request->input('Friday_open');

            if ($friday_open != '---') {
                $open_hours['friday'] = $friday_open;
            }
        }

        if ($request->has('Saturday_open')) {
            $saturday_open = $request->input('Saturday_open');

            if ($saturday_open != '---') {
                $open_hours['saturday'] = $saturday_open;
            }
        }

        if ($request->has('Sunday_open')) {
            $sunday_open = $request->input('Sunday_open');

            if ($sunday_open != '---') {
                $open_hours['sunday'] = $sunday_open;
            }
        }

        //close hours
        $close_hours = [];

        if ($request->has('Monday_close')) {

            $monday_close = $request->input('Monday_close');

            if ($monday_close != '---') {
                $close_hours['monday'] = $monday_close;
            }
        }

        if ($request->has('Tuesday_close')) {
            $tuesday_close = $request->input('Tuesday_close');

            if ($tuesday_close != '---') {
                $close_hours['tuesday'] = $tuesday_close;
            }
        }

        if ($request->has('Wednesday_close')) {
            $wednesday_close = $request->input('Wednesday_close');

            if ($wednesday_close != '---') {
                $close_hours['wednesday'] = $wednesday_close;
            }
        }

        if ($request->has('Thursday_close')) {
            $thursday_close = $request->input('Thursday_close');

            if ($thursday_close != '---') {
                $close_hours['thursday'] = $thursday_close;
            }
        }

        if ($request->has('Friday_close')) {
            $friday_close = $request->input('Friday_close');

            if ($friday_close != '---') {
                $close_hours['friday'] = $friday_close;
            }
        }

        if ($request->has('Saturday_close')) {
            $saturday_close = $request->input('Saturday_close');

            if ($saturday_close != '---') {
                $close_hours['saturday'] = $saturday_close;
            }
        }

        if ($request->has('Sunday_close')) {
            $sunday_close = $request->input('Sunday_close');

            if ($sunday_close != '---') {
                $close_hours['sunday'] = $sunday_close;
            }
        }

        $photos = [];
        $i = 0;
        if ($request->has('images')) {
            $images_str = $request->input('images');
            if (!empty($images_str)) {
                $images_base64_array = explode(',', $images_str);

                foreach ($images_base64_array as $base64) {
                    $image_url = base64_decode($base64);
                    $photos['image' . $i] = $image_url;
                    $i++;
                }
            }
        }


        //contact information
        $contact_name = $request->input('contact_name');
        $contact_title = $request->input('contact_title');
        $contact_email = $request->input('contact_email');
        $contact_phone = $request->input('contact_phone');


        //uploaded time
        date_default_timezone_set("America/New_York");
        $ul_time = time();


        //get GMT timezone based off latitude, longitude

        $venue = [
            'name' => $name,
            'type' => $type,
            'estateType' => $estateType,
            'address' => $address,
            'description' => $description,
            'membershipDetail' => $membershipDetail,
            'isPrivate' => $isPrivate,
            'airbnb' => $airbnb,
            'num_of_seats' => $num_of_seats,
            'phone' => $phone,
            'outdoor' => $outdoor,
            'wifi' => $wifi,
            'weblink' => $weblink,
            'id' => $key,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'open_hours' => $open_hours,
            'close_hours' => $close_hours,
            'photos' => $photos,
            //'timezone' => $timezone,
            'contact_info' => [
                'contact_name' => $contact_name,
                'contact_title' => $contact_title,
                'contact_email' => $contact_email,
                'contat_phone' => $contact_phone
            ],
            'time' => $ul_time,
            'confirm' => $confirm,
        ];

        $this->database->getReference('venues/' . $key)->set($venue);
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function deleteVenue(Request $request, $id)
    {
        $this->database->getReference('venues/' . $id)->remove();
        return response()->json([
            'success' => true
        ]);
    }

    public function confirmVenue(Request $request, $id)
    {
        $this->database->getReference('venues/' . $id)->update([
            'confirm' => true
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function editVenue(Request $request, $id)
    {
        $key = $id;

        $reference = $this->database->getReference('/venues/' . $id);
        $snapshot = $reference->getSnapshot();

        $value = $snapshot->getValue();

        $venue = collect($value);

        if ($request->has('name')) {
            $name = $request->input('name');
        } else {
            $name = 'no name';
        }

        if ($request->has('address')) {
            $address = $request->input('address');
        } else {
            $address = 'no address';
        }

        if ($request->has('lat')) {
            $latitude = $request->input('lat');
        } else {
            $latitude = 0;
        }

        if ($request->has('lng')) {
            $longitude = $request->input('lng');
        } else {
            $longitude = 0;
        }

        if ($request->has('description')) {
            $description = $request->input('description');
        } else {
            $description = '';
        }

        if ($request->has('membershipDetail')) {
            $membershipDetail = $request->input('membershipDetail');
        } else {
            $membershipDetail = '';
        }

        if ($request->has('public')) {
            $public = $request->input('public');


            if ($public == true)
                $isPrivate = false;
            else
                $isPrivate = true;
        } else {
            $isPrivate = true;
        }

        if ($request->has('airbnb')) {
            $airbnb = $request->input('airbnb');
        } else {
            $airbnb = "";
        }

        $num_of_seats = $request->input('num_of_seats');
        $type = $request->input('type');
        $estateType = $request->input('estateType');


        if ($request->has('phone')) {
            $phone = $request->input('phone');
        } else {
            $phone = '';
        }

        if ($request->has('weblink')) {
            $weblink = $request->input('weblink');
        } else {
            $weblink = '';
        }

        if ($request->has('outdoor')) {
            $outdoor = $request->input('outdoor');
        } else {
            $outdoor = false;
        }

        if ($request->has('wifi')) {
            $wifi = $request->input('wifi');
        } else {
            $wifi = false;
        }


        // open hours
        $open_hours = [];

        if ($request->has('Monday_open')) {
            $monday_open = $request->input('Monday_open');

            if ($monday_open != '---') {
                $open_hours['monday'] = $monday_open;
            }
        }

        if ($request->has('Tuesday_open')) {
            $tuesday_open = $request->input('Tuesday_open');

            if ($tuesday_open != '---') {
                $open_hours['tuesday'] = $tuesday_open;
            }
        }

        if ($request->has('Wednesday_open')) {
            $wednesday_open = $request->input('Wednesday_open');

            if ($wednesday_open != '---') {
                $open_hours['wednesday'] = $wednesday_open;
            }
        }

        if ($request->has('Thursday_open')) {
            $thursday_open = $request->input('Thursday_open');

            if ($thursday_open != '---') {
                $open_hours['thursday'] = $thursday_open;
            }
        }

        if ($request->has('Friday_open')) {
            $friday_open = $request->input('Friday_open');

            if ($friday_open != '---') {
                $open_hours['friday'] = $friday_open;
            }
        }

        if ($request->has('Saturday_open')) {
            $saturday_open = $request->input('Saturday_open');

            if ($saturday_open != '---') {
                $open_hours['saturday'] = $saturday_open;
            }
        }

        if ($request->has('Sunday_open')) {
            $sunday_open = $request->input('Sunday_open');

            if ($sunday_open != '---') {
                $open_hours['sunday'] = $sunday_open;
            }
        }

        //close hours
        $close_hours = [];

        if ($request->has('Monday_close')) {

            $monday_close = $request->input('Monday_close');

            if ($monday_close != '---') {
                $close_hours['monday'] = $monday_close;
            }
        }

        if ($request->has('Tuesday_close')) {
            $tuesday_close = $request->input('Tuesday_close');

            if ($tuesday_close != '---') {
                $close_hours['tuesday'] = $tuesday_close;
            }
        }

        if ($request->has('Wednesday_close')) {
            $wednesday_close = $request->input('Wednesday_close');

            if ($wednesday_close != '---') {
                $close_hours['wednesday'] = $wednesday_close;
            }
        }

        if ($request->has('Thursday_close')) {
            $thursday_close = $request->input('Thursday_close');

            if ($thursday_close != '---') {
                $close_hours['thursday'] = $thursday_close;
            }
        }

        if ($request->has('Friday_close')) {
            $friday_close = $request->input('Friday_close');

            if ($friday_close != '---') {
                $close_hours['friday'] = $friday_close;
            }
        }

        if ($request->has('Saturday_close')) {
            $saturday_close = $request->input('Saturday_close');

            if ($saturday_close != '---') {
                $close_hours['saturday'] = $saturday_close;
            }
        }

        if ($request->has('Sunday_close')) {
            $sunday_close = $request->input('Sunday_close');

            if ($sunday_close != '---') {
                $close_hours['sunday'] = $sunday_close;
            }
        }

        if ($request->has('confirm')) {
            $confirm = $request->input('confirm');
        } else {
            $confirm = false;
        }

        $contact_name = $request->input('contact_name');
        $contact_title = $request->input('contact_title');
        $contact_email = $request->input('contact_email');
        $contact_phone = $request->input('contact_phone');

        $contact_info = [
            'contact_name' => $contact_name,
            'contact_title' => $contact_title,
            'contact_email' => $contact_email,
            'contat_phone' => $contact_phone
        ];

        $venue['name'] = $name;
        $venue['type'] = $type;
        $venue['estateType'] = $estateType;
        $venue['address'] = $address;
        $venue['description'] = $description;
        $venue['membershipDetail'] = $membershipDetail;
        $venue['isPrivate'] = $isPrivate;
        $venue['airbnb'] = $airbnb;
        $venue['num_of_seats'] = $num_of_seats;
        $venue['phone'] = $phone;
        $venue['outdoor'] = $outdoor;
        $venue['wifi'] = $wifi;
        $venue['weblink'] = $weblink;
        $venue['id'] = $key;
        $venue['latitude'] = $latitude;
        $venue['longitude'] = $longitude;
        $venue['open_hours'] = $open_hours;
        $venue['close_hours'] = $close_hours;
        $venue['confirm'] = $confirm;
        $venue['contact_info'] = $contact_info;


        $i = 0;
        if ($request->has('images')) {
            $images_str = $request->input('images');
            if (!empty($images_str)) {
                $photos = [];

                $images_base64_array = explode(',', $images_str);

                foreach ($images_base64_array as $base64) {
                    $image_url = base64_decode($base64);
                    $photos['image' . $i] = $image_url;
                    $i++;
                }

                if (count($photos) > 0) {
                    $venue['photos'] = $photos;
                }
            }
        }

        $this->database->getReference('venues/' . $key)->set($venue);
    }

    public function exportVenues($type)
    {

        $snapshot = $this->reference->getSnapshot();
        $value = $snapshot->getValue();
        $venues = collect($value);
        $datas = $venues->toArray();

        $venues_data = [];

        //Define Spreadsheet headers
        $venues_header = ['address', 'airbnb', 'confirm', 'description', 'estateType', 'id', 'isPrivate', 'latitude', 'longitude', 'membershipDetail', 'name',
            'num_of_seats', 'outdoor', 'phone', 'photos', 'type', 'weblink', 'wifi', 'close_hours', 'open_hours', 'contact_info'];

        $venues_data[] = $venues_header;

        foreach ($datas as $data) {

            $venue_one = [];

            foreach ($venues_header as $key0 => $header_name) {
                if (array_key_exists($header_name, $data)) {

                    if (is_array($data[$header_name])) {

                        $data1_str = '';

                        foreach ($data[$header_name] as $key1 => $data1) {
                            $data1_str .= $key1 . '-' . $data1 . ',';
                        }

                        $data1_str = rtrim($data1_str, ',');

                        $venue_one[$header_name] = $data1_str;

                    } else {
                        $venue_one[$header_name] = $data[$header_name];
                    }
                } else {
                    $venue_one[$header_name] = '';
                }
            }

            $venues_data[] = $venue_one;
        }

        return Excel::create('Venues', function ($excel) use ($venues_data) {

            $excel->setTitle('Venues');
            $excel->setCreator('admin.smokehereapp.com')->setCompany('BrainyApps');
            $excel->setDescription('Verified and Pending Venues');

            $excel->sheet('mySheet', function ($sheet) use ($venues_data) {
                $sheet->fromArray($venues_data, null, 'A1', false, false);
            });
        })->download($type);
    }
}
