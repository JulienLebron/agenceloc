<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\User;
use App\Entity\Vehicule;
use App\Form\CommandeType;
use App\Form\VehiculeType;
use App\Repository\CommandeRepository;
use App\Repository\UserRepository;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    // Administration des véhicules

    #[Route('/admin/vehicules', name: 'admin_vehicules')]
    public function adminVehicules(VehiculeRepository $repo, EntityManagerInterface $em)
    {
        // récupération des noms des colonnes SQL
        $colonnes = $em->getClassMetadata(Vehicule::class)->getFieldNames();
        // récupérations de tout les articles
        $vehicules = $repo->findAll();

        return $this->render('admin/admin_vehicules.html.twig', [
            'vehicules' => $vehicules,
            'colonnes' => $colonnes
        ]);
    }

    #[Route('/admin/vehicule/new', name: 'admin_new_vehicule')]
    #[Route('/admin/{id}/edit-vehicule', name: 'admin_edit_vehicule')]
    public function editVehicule(Request $request, EntityManagerInterface $manager, Vehicule $vehicule = null)
    {
        // la classe Request contient les données véhiculées par les superglobales ($_POST, $_GET ...)
        // $vehicule = new Vehicule; // je crée un objet Vehicule vide prêt à être rempli
        if($vehicule == null)
        {
            $vehicule = new Vehicule;
            $vehicule->setCreatedAt(new \DateTime()); // ajout de la date à l'insertion de l'vehicule
        }
        $form = $this->createForm(VehiculeType::class, $vehicule);
        // createForm() permet de récupérer un formulaire
        dump($request); // permet d'afficher les données de l'objet $request
        $form->handleRequest($request);
        // handleRequest() permet d'insérer les données du formulaire dans l'objet $vehicule
        // Pour pouvoir insérer les données en BDD, on récupère le manager et on ajoute le code d'insertion
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($vehicule); // prépare l'insertion de l'vehicule
            $manager->flush(); // on exécute la requête d'insertion 
            // cette méthode permet de nous rediriger vers la page de notre vehicule nouvellement crée
            $this->addFlash('success', "✅ L'action sur le véhicule à été réalisé avec succès !");
            return $this->redirectToRoute('admin_vehicules');
        }
        return $this->render('admin/form_vehicule.html.twig', [
            'formEdit' => $form->createView(),
            // createView() renvoie un objet représentant l'affichage du formulaire
            'editMode' => $vehicule->getId() !== NULL 
            // si nous sommes sur la route /new : editMode = 0
            // sinon, editMode = 1
        ]);
    }

    #[Route('/admin/{id}/delete-vehicule', name: 'admin_delete_vehicule')]
    public function deleteVehicule(Vehicule $vehicule, EntityManagerInterface $manager)
    {
        $manager->remove($vehicule);
        $manager->flush();

        // on envoi un message d'alerte vers la vue
        $this->addFlash('success', "✅ Le véhicule à bien été supprimé !");

        return $this->redirectToRoute('admin_vehicules');
    }

     // Administration des membres

     #[Route('/admin/users', name: 'admin_users')]
     public function adminUsers(UserRepository $repo, EntityManagerInterface $em)
     {
         // récupération des noms des colonnes SQL
         $colonnes = $em->getClassMetadata(User::class)->getFieldNames();
         // récupérations de tout les articles
         $users = $repo->findAll();
 
         return $this->render('admin/admin_users.html.twig', [
             'users' => $users,
             'colonnes' => $colonnes
         ]);
     }

     #[Route('/admin/{id}/delete-user', name: 'admin_delete_user')]
     public function deleteUser(User $user, EntityManagerInterface $manager)
     {
         $manager->remove($user);
         $manager->flush();
 
         // on envoi un message d'alerte vers la vue
         $this->addFlash('success', "✅ L'utilisateur à bien été supprimé !");
 
         return $this->redirectToRoute('admin_users');
     }

     // Administration des commandes

     #[Route('/admin/commandes', name: 'admin_commandes')]
     public function adminCommandes(CommandeRepository $repo, EntityManagerInterface $em)
     {
         // récupération des noms des colonnes SQL
         $colonnes = $em->getClassMetadata(Commande::class)->getFieldNames();
         // récupérations de tout les articles
         $commandes = $repo->findAll();
 
         return $this->render('admin/admin_commandes.html.twig', [
             'commandes' => $commandes,
             'colonnes' => $colonnes
         ]);
     }

     #[Route('/admin/commande/new', name: 'admin_new_commande')]
     #[Route('/admin/{id}/edit-commande', name: 'admin_edit_commande')]
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
             $manager->persist($commande); // prépare l'insertion de l'commande
             $manager->flush(); // on exécute la requête d'insertion 
             // cette méthode permet de nous rediriger vers la page de notre commande nouvellement crée
             $this->addFlash('success', "✅ L'action sur la commande à été réalisé avec succès !");
             return $this->redirectToRoute('admin_commandes');
         }
         return $this->render('agence/form_commande.html.twig', [
             'formEdit' => $form->createView(),
             // createView() renvoie un objet représentant l'affichage du formulaire
             'editMode' => $commande->getId() !== NULL 
             // si nous sommes sur la route /new : editMode = 0
             // sinon, editMode = 1
         ]);
     }

     #[Route('/admin/{id}/delete-commande', name: 'admin_delete_commande')]
     public function deleteCommande(Commande $commande, EntityManagerInterface $manager)
     {
         $manager->remove($commande);
         $manager->flush();
 
         // on envoi un message d'alerte vers la vue
         $this->addFlash('success', "✅ La commande à bien été annulé !");
 
         return $this->redirectToRoute('admin_commandes');
     }
     


}
