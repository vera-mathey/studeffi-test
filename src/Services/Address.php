<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class Address
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getAddress(string $query): ?string
    {
        // Effectuer la requête vers l'API
        $response = $this->client->request('GET', 'https://api-adresse.data.gouv.fr/search/', [
            'query' => [
                'q' => $query,
                'limit' => 1
            ]
        ]);

        // Convertir la réponse JSON en tableau
        $data = $response->toArray();


        if (!empty($data['features'])) {
            // Récupérer l'adresse depuis la réponse

            return $data ['futures'][0]['properties']['label'];
        }

        return null; // Si aucune donnée n'est trouvée
    }
}