<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeamMatch;
use App\Models\Teams;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GetdataFootball extends Controller
{
    public function GetTeamCountryIDs($searchBynameCountrys, $searchBynameTeams)
    {
        $searchBynameCountry = $searchBynameCountrys ?? 'Egypt';
        $searchBynameTeam = $searchBynameTeams ?? 'Al Ahly';

        $countryApi = 'https://livescore-api.com/api-client/countries/list.json?key=1JKfdLXo4XcZWuHd&secret=UvOkuPOkj5pnfaPgUAv8ltwpqIpnd6A7';
        $responseCountry = Http::get($countryApi);

        if ($responseCountry->successful()) {
            $josnResponse = $responseCountry->json();
            $data = $josnResponse['data']['country'];
            $result = collect($data)->first(function ($item) use ($searchBynameCountry) {
                return $item['name'] == $searchBynameCountry;
            });
            if ($result) {
                $id = $result['id'];
            } else {
                return response('not found');
            }
        } else {
            return response()->json(['error' => 'Failed to fetch data from the API'], $responseCountry->status());
        }

        $teamApi = "https://livescore-api.com/api-client/teams/list.json?country_id=$id&key=1JKfdLXo4XcZWuHd&secret=UvOkuPOkj5pnfaPgUAv8ltwpqIpnd6A7&language=ar";
        $responseTeam = Http::get($teamApi);
        $josnResponseTeam = $responseTeam->json();
        $dataTeam = $josnResponseTeam["data"]["teams"];
        $result = collect($dataTeam)->first(function ($item) use ($searchBynameTeam) {
            return $item['name'] == $searchBynameTeam;
        });
        if ($result) {
            $idTeam = $result['id'];
        } else {
            return response('not found');
        }
        return [
            'teamId' => $idTeam,
            'CountryId' => $id
        ];
    }

    public function GetTeamSchedule(Request $request)
    {
        // Calculate start and end dates for next week
        $startOfWeek = Carbon::now()->startOfWeek()->addWeek(); // Start of next week
        $endOfWeek = Carbon::now()->endOfWeek()->addWeek(); // End of next week

        $teams = Teams::all();
        $nextWeekMatches = [];

        foreach ($teams as $team) {
            $id = $team->team_api_id;
            $teamFIXTURES = "https://livescore-api.com/api-client/fixtures/matches.json?&key=1JKfdLXo4XcZWuHd&secret=UvOkuPOkj5pnfaPgUAv8ltwpqIpnd6A7&team=$id";
            $responseFixtures = Http::get($teamFIXTURES);
            $jsonResponse = $responseFixtures->json();
            $data = $jsonResponse["data"]['fixtures'];

            foreach ($data as $match) {
                // Parse match date
                $matchDate = Carbon::parse($match['date']);

                // Check if the match date is within next week
                if ($matchDate->between($startOfWeek, $endOfWeek)) {
                    $nextWeekMatches[] = [
                        'team_id' => $id,
                        'away_name' => $match['away_name'],
                        'date' => $match['date'],
                        'location' => $match['location'],
                    ];
                }
            }
        }

        return response()->json($nextWeekMatches);
    }
    public function GetTeamDateHistory(Request $request)
    {
        $yesterday = Carbon::yesterday()->format('Y-m-d');

        $teams = Teams::all();
        $yesterdayMatches = [];

        foreach ($teams as $team) {
            $id = $team->team_api_id;
            $teamHistory = "https://livescore-api.com/api-client/scores/history.json?key=1JKfdLXo4XcZWuHd&secret=UvOkuPOkj5pnfaPgUAv8ltwpqIpnd6A7&team=$id";
            $responseTeamHistory = Http::get($teamHistory);
            $jsonResponse = $responseTeamHistory->json();
            $data = $jsonResponse["data"]['match'];

            foreach ($data as $match) {
                // Check if the match date is yesterday
                if (Carbon::parse($match['date'])->format('Y-m-d') === $yesterday) {
                    $yesterdayMatches[] = [
                        'team_id' => $id,
                        'old_score' => $match['ht_score'],
                        'away_name' => $match['away_name'],
                        'location' => $match['location'],
                        'status' => $match['status'],
                        'date' => $match['date'],
                    ];
                }
            }
        }
        TeamMatch::insert($yesterdayMatches);
        return response()->json($yesterdayMatches);
    }


    // public function GetFlags(Request $request)
    // {
    //     $flagsApi = "https://livescore-api.com/api-client/fixtures/matches.json?key=1JKfdLXo4XcZWuHd&secret=UvOkuPOkj5pnfaPgUAv8ltwpqIpnd6A7&team=$teamId";
    //     $responseFixtures = Http::get($flagsApi);
    //     $jsonResponse = $responseFixtures->json();
    //     $data = $jsonResponse["data"]['fixtures'];

    //     return response()->json($data);
    // }



    public function setup_teams_data(Request $request)
    {


        $CountryApi = "https://livescore-api.com/api-client/countries/list.json?&key=1JKfdLXo4XcZWuHd&secret=UvOkuPOkj5pnfaPgUAv8ltwpqIpnd6A7";
        $responseCountry = Http::get($CountryApi);
        $jsonResponseCountry = $responseCountry->json();
        $Country = $jsonResponseCountry["data"]['country'];
        $limitedCountry = array_slice($Country, 0, 5);

        // for ($i = 0; $i <= 263; $i++) {
        //     $teamsApi = "https://livescore-api.com/api-client/teams/listing.json?&key=1JKfdLXo4XcZWuHd&secret=UvOkuPOkj5pnfaPgUAv8ltwpqIpnd6A7&page=$i";
        //     $response = Http::get($teamsApi);
        //     $jsonResponse = $response->json();
        //     $data = $jsonResponse["data"]['teams'];
        //     $limitedData = array_slice($data, 0, 5);
        //     foreach ($limitedData as $team) {
        //         $teamData = Teams::where('team_api_id', $team['team']['id'])->first();
        //         if (!$teamData) {
        //             Teams::create([
        //                 'team_api_id' => $team['team']['id'],
        //                 'name' => $team['team']['name'],
        //                 'is_club' => 1,
        //             ]);
        //         } else {
        //             $teamData->update([
        //                 'team_api_id' => $team['team']['id'],
        //                 'name' => $team['team']['name'],
        //                 'is_club' => 1,
        //             ]);
        //         }
        //     }
        // }

        foreach ($limitedCountry as $country) {
            $countrydata = Teams::where('team_api_id', $country['id'])->first();

            $id = $country['id'];
            $flagApi = "https://livescore-api.com/api-client/countries/flag.json?country_id=71&key=1JKfdLXo4XcZWuHd&secret=UvOkuPOkj5pnfaPgUAv8ltwpqIpnd6A7";
            $responseFlag = Http::get($flagApi);
            $imageContent = file_get_contents($responseFlag);
            $filename = 'image_' . uniqid() . '.jpg';
            Storage::disk('public')->put('image/flags/' . $filename, $imageContent);


            if (!$countrydata) {
                $countrys = Teams::create([
                    'team_api_id' => $country['id'],
                    'name' => $country['name'],
                    'is_club' => 0,
                ]);
            } else {
                $countrydata->update([
                    'team_api_id' => $country['id'],
                    'name' => $country['name'],
                    'is_club' => 0,
                ]);
            }
        }
        return response()->json(Teams::all());
    }

}
