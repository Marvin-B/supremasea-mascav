<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Entity\Partie;
use App\Repository\CarteRepository;
use App\Repository\PartieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


    /**
     * @Route("/partie")
     * */
class PartieController extends AbstractController
{
    /**
     * @Route("/nouvelle-partie", name="nouvelle_partie")
     * */
    public function nouvellePartie(
        EntityManagerInterface $entityManager,
        CarteRepository $carteRepository
    ): Response
    {

        $cartesJ1 = $carteRepository->findBy(['camp' => Carte::CAMP_J1]);
        $leaderJ1 = $carteRepository->findOneBy(['camp' => Carte::CAMP_LEADER_J1]);
        $cartesJ2 = $carteRepository->findBy(['camp' => Carte::CAMP_J2]);
        $leaderJ2 = $carteRepository->findOneBy(['camp' => Carte::CAMP_LEADER_J2]);

        $tempTerrainJ1 = [];
        foreach ($cartesJ1 as $carte) {
            $tempTerrainJ1[] = $carte->getId();
        }
        shuffle($tempTerrainJ1);
        $terrainJ1[0] = [$leaderJ1->getId(), $tempTerrainJ1[1], $tempTerrainJ1[2], $tempTerrainJ1[3]];
        $terrainJ1[1] = [$tempTerrainJ1[4], $tempTerrainJ1[5], $tempTerrainJ1[6]];
        $terrainJ1[2] = [$tempTerrainJ1[7], $tempTerrainJ1[8]];
        $terrainJ1[3] = [$tempTerrainJ1[0]];
        for($i=4; $i < 10; $i++) {
            $terrainJ1[$i] = [];
        }

        $tempTerrainJ2 = [];
        foreach ($cartesJ2 as $carte) {
            $tempTerrainJ2[] = $carte->getId();
        }
        shuffle($tempTerrainJ2);
        $terrainJ2[0] = [$leaderJ2->getId(), $tempTerrainJ2[1], $tempTerrainJ2[2], $tempTerrainJ2[3]];
        $terrainJ2[1] = [$tempTerrainJ2[4], $tempTerrainJ2[5], $tempTerrainJ2[6]];
        $terrainJ2[2] = [$tempTerrainJ2[7], $tempTerrainJ2[8]];
        $terrainJ2[3] = [$tempTerrainJ2[0]];
        for($i=4; $i < 10; $i++) {
            $terrainJ2[$i] = [];
        }

        $partie = new Partie();
        $partie->setTerrainJ1($terrainJ1);
        $partie->setTerrainJ2($terrainJ2);


        $entityManager->persist($partie);
        $entityManager->flush();


        return $this->redirectToRoute("afficher_partie", [
            'partie' => $partie->getId()
        ]);
    }
    /**
     * @Route("/parties-en-cours", name="partie_en_cours")
     * */

    public function partiesEnCours(PartieRepository $partieRepository): Response
    {
        return $this->render("partie/partie_en_cours.html.twig",
            [
        'parties'  =>   $partieRepository->findAll()
        ]);
    }

    /**
     * @Route("/{partie}", name="afficher_partie")
     * */
    public function afficherPartie(Partie $partie): Response
    {


        return $this->render("partie/afficher_partie.html.twig",
            [
                'partie' => $partie,
            ]);
    }

    /**
     * @Route("/refresh-partie/{partie}", name="refresh_partie")
     * */
    public function refreshPlateau(CarteRepository $carteRepository, Partie $partie): Response
    {
        //récupération de toutes les cartes
        $cartes = $carteRepository->findAll();
        $tCartes = [];
        foreach ($cartes as $carte) {
            $tCartes[$carte->getId()] = $carte;
        }

        return $this->render('partie/_plateau_partie.html.twig',
            [
                'partie' => $partie,
                'cartes' => $tCartes,
                'terrains' => Carte::TERRAINS
            ]);
    }
}
