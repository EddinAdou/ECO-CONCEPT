<?php

namespace App\Controller;

use AllowDynamicProperties;
use App\Service\ServiceAnalyzer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use App\Entity\AnalyzeSite;

class AnalyzeController extends AbstractController
{
    private ServiceAnalyzer $serviceAnalyzer;
    private EntityManagerInterface $entityManager;

    public function __construct(ServiceAnalyzer $serviceAnalyzer, EntityManagerInterface $entityManager)
    {
        $this->serviceAnalyzer = $serviceAnalyzer;
        $this->entityManager = $entityManager;
    }
    #[Route('/api/analyze', name: 'api_analyze', methods: ['GET', 'POST'])]
    public function analyse(Request $request, LoggerInterface $logger): JsonResponse
    {
        $logger->info('Début de l\'analyse');

        $data = json_decode($request->getContent(), true);
        $url = $data['url'] ?? null;

        if (!$url) {
            $logger->info('URL manquante');
            return new JsonResponse(['error' => 'URL manquante'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $logger->info('URL analysée: ' . $url);

        $result = $this->serviceAnalyzer->analyser($url);

        if (isset($result['error'])) {
            $logger->error('Erreur lors de l\'analyse: ' . $result['error']);
            return new JsonResponse($result, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        $logger->info('Analyse réussie avec score: ' . $result['score']);

        // Créer une nouvelle entité Analyse
        $analyse = new AnalyzeSite();
        $analyse->setUrl($url);
        $analyse->setScore($result['score']);
        $analyse->setNote($result['note']);
        $analyse->setPoidsTotal($result['poidsTotal']);
        $analyse->setNbRequetes($result['nbRequetes']);
        $analyse->setAppreciation($result['appreciation']);
        $analyse->setEmpreinteCarbone($result['empreinte_carbone']);
        $analyse->setEmpreinteEau($result['empreinte_eau']);
        $analyse->setDateAnalyse(new \DateTime()); // Ajoute la date actuelle comme date d'analyse
        $analyse->setOptimiserImages($result['optimiser_images'] ?? false);
        $analyse->setReduireRequettes($result['reduire_requettes'] ?? false);

        // Persister et sauvegarder
        $this->entityManager->persist($analyse);
        $this->entityManager->flush();

        $logger->info('Données sauvegardées en base');

        return new JsonResponse($result);
    }

}