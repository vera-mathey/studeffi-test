<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GeoService
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getInseeCode(string $city, string $postalCode): ?string
    {
        // Effectuer la requête vers l'API
        $response = $this->client->request('GET', 'https://api-adresse.data.gouv.fr/search/', [
            'query' => [
                'q' => $city,         // Ville
                'postcode' => $postalCode,  // Code postal
            ],
        ]);

        // Convertir la réponse JSON en tableau
        $data = $response->toArray();

        // Vérifier la réponse et extraire le code INSEE
        if (!empty($data['features'])) {
            // Récupérer le code INSEE depuis la réponse
            $inseeCode = $data['features'][0]['properties']['citycode'];
            return $inseeCode;
        }

        return null; // Si aucune donnée n'est trouvée
    }
}