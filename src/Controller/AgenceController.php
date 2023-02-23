<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\UserRepository;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class AgenceController extends AbstractController
{
    #[Route('/agence', name: 'app_agence')]
    public function index(): Response
    {
        return $this->render('agence/index.html.twig', [
            'controller_name' => 'AgenceController',
        ]);
    }

    #[Route('/', name: 'home')]
    public function home(VehiculeRepository $repo): Response
    {
        $vehicules = $repo->findAll();
        return $this->render('agence/home.html.twig', [
            'title' => 'Bienvenue sur notre Agence',
            'vehicules' => $vehicules
        ]);
    }
    
    #[Route('/agence/show/{id}', name: 'agence_show')]
    public function show(VehiculeRepository $repo, $id)
    {
        /*
        Pour sélectionner un article dans la BDD, nous utilisons le principe de route paramétrée
        Dans la route, on définit un paramètre de type {id}
        Lorsque nous transmettons dans l'URL par exemple une route '/blog/9', on envoie un id conne en BDD dans l'URL
        Symfony va automatiquement récupérer ce paramètre et le transmettre en argument de la méthode show()
        */
        $vehicule = $repo->find($id);
        return $this->render('agence/show.html.twig', [
            'vehicule' => $vehicule
        ]);
    }

    #[Route('/agence/profil', name: 'profil')]
    public function profil(Security $security): Response
    {
        $user = $security->getUser();
        dump($user);
        return $this->render('agence/profil.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/agence/commande/new', name: 'agence_new_commande')]
     #[Route('/agence/{id}/edit-commande', name: 'agence_edit_commande')]
     public function editCommande(Request $request, EntityManagerInterface $manager, Commande $commande = null, Security $security)
     {
         // la classe Request contient les données véhiculées par les superglobales ($_POST, $_GET ...)
         // $vehicule = new Vehicule; // je crée un objet Vehicule vide prêt à être rempli
         if($commande == null)
         {
            $user = $security->getUser();
            dump($user);
            $commande = new Commande;
            $commande->setCreatedAt(new \DateTime()); // ajout de la date à l'insertion de l'commande
            $commande->setUsers($user);
         }
         $form = $this->createForm(CommandeType::class, $commande);
         // createForm() permet de récupérer un formulaire
         dump($request); // permet d'afficher les données de l'objet $request
         $form->handleRequest($request);
         // handleRequest() permet d'insérer les données du formulaire dans l'objet $commande
         // Pour pouvoir insérer les données en BDD, on récupère le manager et on ajoute le code d'insertion
         if($form->isSubmitted() && $form->isValid())
         {
            $tarif = $commande->getVehicules()->getPrice();
             $debut = $commande->getStartAt();
             $fin = $commande->getEndAt();
             $interval = $debut->diff($fin);
             $days = $interval->days;
             $commande->setTotal($days * $tarif);
            //  $total = $commande->getTotal();
            //  dd($total);
             $manager->persist($commande); // prépare l'insertion de l'commande
             $manager->flush(); // on exécute la requête d'insertion 
             // cette méthode permet de nous rediriger vers la page de notre commande nouvellement crée
             $this->addFlash('success', "✅ L'action sur la commande à été réalisé avec succès !");
             return $this->redirectToRoute('profil');
         }
         return $this->render('agence/form_commande.html.twig', [
             'formEdit' => $form->createView(),
             // createView() renvoie un objet représentant l'affichage du formulaire
             'editMode' => $commande->getId() !== NULL 
             // si nous sommes sur la route /new : editMode = 0
             // sinon, editMode = 1
         ]);
     }

}
