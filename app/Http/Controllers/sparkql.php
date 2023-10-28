<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class sparkql extends Controller
{
    public function fetchData()
    {
        $sparqlEndpoint = "http://localhost:3030/sportify/query";
        $query = "
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX untitled-ontology-2: <http://www.semanticweb.org/lenovo/ontologies/2023/9/untitled-ontology-2#>
        
        SELECT ?nomTrophée ?annéeObtention
        WHERE {
          untitled-ontology-2:CoupeDuMonde2022 rdf:type untitled-ontology-2:Trophée;
                                              untitled-ontology-2:annéeObtention ?annéeObtention;
                                              untitled-ontology-2:nomTrophée ?nomTrophée.
        }
        
        ";

        $client = new Client();
        $response = $client->request('GET', $sparqlEndpoint, [
            'query' => [
                'query' => $query,
                'format' => 'json'
            ]
        ]);

        if ($response->getStatusCode() == 200) {
            $results = json_decode($response->getBody()->getContents());
            return view('spark', ['results' => $results->results->bindings]);
        } else {
            // Gérer l'erreur ici
            return view('error');
        }
    }
}
