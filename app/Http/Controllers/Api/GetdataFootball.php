<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

        $contry = $request->country;
        $team = $request->team;
        $getTeamCountryDs = $this->GetTeamCountryIDs($contry, $team);

        $teamId = $getTeamCountryDs['teamId'];
        $teamFIXTURES = "https://livescore-api.com/api-client/fixtures/matches.json?key=1JKfdLXo4XcZWuHd&secret=UvOkuPOkj5pnfaPgUAv8ltwpqIpnd6A7&team=$teamId";
        $responseFixtures = Http::get($teamFIXTURES);
        $jsonResponse = $responseFixtures->json();
        $data = $jsonResponse["data"]['fixtures'];

        return response()->json($data);
    }
    public function GetTeamDateHistory(Request $request)
    {
        $contry = $request->country;
        $team = $request->team;
        $getTeamCountryDs = $this->GetTeamCountryIDs($contry, $team);

        $teamId = $getTeamCountryDs['teamId'];
        $teamFIXTURES = "https://livescore-api.com/api-client/fixtures/matches.json?key=1JKfdLXo4XcZWuHd&secret=UvOkuPOkj5pnfaPgUAv8ltwpqIpnd6A7&team=$teamId";
        $rsponeTeamHistory = Http::get($teamFIXTURES);
        $jsonResponse = $rsponeTeamHistory->json();
        $data = $jsonResponse["data"]['fixtures'];

        return response()->json($data);
    }
    public function GetFlags(Request $request)
    {
        $flagsApi = "https://livescore-api.com/api-client/fixtures/matches.json?key=1JKfdLXo4XcZWuHd&secret=UvOkuPOkj5pnfaPgUAv8ltwpqIpnd6A7&team=$teamId";
        $responseFixtures = Http::get($flagsApi);
        $jsonResponse = $responseFixtures->json();
        $data = $jsonResponse["data"]['fixtures'];

        return response()->json($data);
    }

    

    public function setup_teams_data(Request $request)
    {
        $teamsApi = "https://livescore-api.com/api-client/teams/listing.json?key=M4cVl7zql51jtexw&secret=JDKMIMeXgyE2dxhZBuVXBvoXBpg4DOBm";
        $response = Http::get($teamsApi);
        $jsonResponse = $response->json();
        $data = $jsonResponse["data"][''];

        foreach ($data as $team) {
            // this bugs   
            $teamData = Teams::where('team_api_id', $team->id)->first();
            if (!$teamData) {
                Teams::create([
                    '' => ''
                ]);
            } else {
                $teamData->update([
                    '' => ''
                ]);
            }
        }
        return response()->json($data);
    }

}
