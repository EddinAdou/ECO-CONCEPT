<?php

namespace App\Service;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ServiceAnalyzer
{
    private $client;

    public function __construct()
    {
        // Initialize the Guzzle client for HTTP requests
        $this->client = new Client();
    }

    public function analyser(string $url): array
    {
        try {
            // Fetch the page with Guzzle
            $response = $this->client->get($url);
            $html = $response->getBody()->getContents();

            // Use DomCrawler to analyze the HTML content
            $crawler = new Crawler($html);

            // Extract CSS, JS, and image files
            $cssFiles = $crawler->filter('link[rel="stylesheet"]')->each(fn ($node) => $node->attr('href'));
            $jsFiles = $crawler->filter('script[src]')->each(fn ($node) => $node->attr('src'));
            $images = $crawler->filter('img[src]')->each(fn ($node) => $node->attr('src'));

            // Calculate the total weight of the files
            $poidsTotal = count($cssFiles) * 0.1 + count($jsFiles) * 0.2 + count($images) * 0.5;

            // Total number of HTTP requests
            $nbRequetes = count($cssFiles) + count($jsFiles) + count($images);

            // Calculate the complexity of the DOM
            $domElements = $crawler->filter('*')->count();

            // Calculate quantiles for each criterion
            $quantileDOM = $this->calculerQuantileDOM($domElements);
            $quantileHttp = $this->calculerQuantileHttp($nbRequetes);
            $quantileData = $this->calculerQuantileData($poidsTotal);

            // Calculate the EcoIndex with weighting
            $ecoIndex = $this->calculerEcoIndex($quantileDOM, $quantileHttp, $quantileData);

            // Determine the score, note, and appreciation based on the EcoIndex
            $noteData = $this->determinerNoteEtAppreciation($ecoIndex);

            // Ajouter des valeurs pour l'empreinte carbone et l'eau si elles sont calculées
            $empreinteCarbone = $poidsTotal * 0.2; // Exemple de calcul
            $empreinteEau = $poidsTotal * 0.1; // Exemple de calcul

            return array_merge([
                'poidsTotal' => $poidsTotal,
                'nbRequetes' => $nbRequetes,
                'domElements' => $domElements,
                'ecoIndex' => $ecoIndex,
                'score' => $ecoIndex,
                'empreinte_carbone' => $empreinteCarbone,
                'empreinte_eau' => $empreinteEau,
                'optimiser_images' => true, // ou calculer la valeur réelle
                'reduire_requettes' => true // ou calculer la valeur réelle
            ], $noteData);

        } catch (\Exception $e) {
            // In case of error, return an error message
            return [
                'error' => 'An error occurred during the analysis.',
                'message' => $e->getMessage(),
            ];
        }
    }


    private function calculerQuantileDOM(int $domElements): float
    {
        $domMaxOptimal = 700;
        return min(1, $domElements / $domMaxOptimal);
    }

    private function calculerQuantileHttp(int $nbRequetes): float
    {
        $requeteMaxOptimal = 30;
        return min(1, $nbRequetes / $requeteMaxOptimal);
    }

    private function calculerQuantileData(float $poidsTotal): float
    {
        $poidsMaxOptimal = 1.0;
        return min(1, $poidsTotal / $poidsMaxOptimal);
    }


    private function calculerEcoIndex(float $quantileDOM, float $quantileHttp, float $quantileData): int
    {
        // Calcul de l'EcoIndex avec pondération
        $ecoIndex = 100 - (1/6) * (3 * $quantileDOM + 2 * $quantileHttp + 1 * $quantileData);

        // Arrondir le résultat à l'entier le plus proche
        return round($ecoIndex);
    }



    private function determinerNoteEtAppreciation(float $ecoIndex): array
    {
        if ($ecoIndex >= 90) {
            return ['note' => 'A', 'appreciation' => 'Excellent'];
        } elseif ($ecoIndex >= 80) {
            return ['note' => 'B', 'appreciation' => 'Très bien'];
        } elseif ($ecoIndex >= 70) {
            return ['note' => 'C', 'appreciation' => 'Bien'];
        } elseif ($ecoIndex >= 60) {
            return ['note' => 'D', 'appreciation' => 'Moyen'];
        } elseif ($ecoIndex >= 50) {
            return ['note' => 'E', 'appreciation' => 'Passable'];
        } elseif ($ecoIndex >= 40) {
            return ['note' => 'F', 'appreciation' => 'Insuffisant'];
        } else {
            return ['note' => 'G', 'appreciation' => 'Très mauvais'];
        }
    }


}