<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Personne;
use App\Entity\Adresse;
use App\Repository\PersonneRepository;
class PersonneController extends AbstractController
{
    /**
     * @Route("/personne/add", name="personne_add")
     */
    #la solution la plus simple est d'injecter le gestionnaire d’entité dans l’action
    public function addPersonne(EntityManagerInterface $entiyManager):Response
    {
        #créer un objet de type Adresse
        $adresse=new Adresse();
        $adresse->setRue("Route El Ain");
        $adresse->setVille("Sfax");
        $adresse->setCodePostal(3066);
        #créer un objet de type Personne
        $personne =new Personne();
        $personne->setNom("Kouki");
        $personne->setPrenom("Ahmed");
        $personne->setSexe("Masculin");
        $personne->setEmail("ahmed.kouki@gmail.com");
        $personne->setAdresse($adresse);
        #informe Doctrine que l’on veut ajouter cet objet dans la base de données
        $entiyManager->persist($personne);
        /*permet d’exécuter la requête et d’envoyer à la BD, tout ce qui a qui 
        a été persisté dans l'EntityManager.*/
        $entiyManager->flush();
        return $this->render('personne/index.html.twig', [
            'personne'=>$personne,
            'adjectif'=>'ajoutée'
        ]);
    }
    /**
    * @Route("/personne/edit/{id}", name="personne_update")
    */
    public function updatePersonne(Personne $personne, EntityManagerInterface $entityManager)
    {
        if (!$personne) {
            throw $this->createNotFoundException('Personne non trouvée avec l\'id '.$personne->id);
        }
        # Spécifier les modifications sur l'entité
        $personne->setNom('jerbi');
        $personne->setEmail('ali.jerbi@gmail.com');
        # Enregistrer les modifications de cette personne dans la table associée à l'entité
        $entityManager->flush();
        # Afficher le résultat dans la vue
        return $this->render('personne/index.html.twig', [
            'personne'=>$personne,
            'adjectif'=>'modifiée'
        ]);
        
    }
    /**
    * @Route("/personne/delete/{id}", name="personne_delete")
    */
    public function deletePersonne(Personne $personne, EntityManagerInterface $entityManager)
    {
        if (!$personne) {
            throw $this->createNotFoundException('Personne non trouvée avec l\'id '.$personne->id);
        }
        # suppression de l'entité
        $entityManager->remove($personne);
        # enregisrer la supression dans la table
        $entityManager->flush();
        # Afficher la liste des personnes restants
        return $this->redirectToRoute('personne_show_all');
    }
    /**
    * @Route("/personne/{id}", name="personne_show")
    */
    public function showPersonne(int $id, PersonneRepository $personneRepository)
    {

        $personne = $personneRepository->find($id);
        if (!$personne) {
            throw $this->createNotFoundException('Personne non trouvée avec l\'id '.$id);
        }
        return $this->render('personne/index.html.twig', [
            'personne' => $personne,
            'adjectif' => 'recherchée'
        ]);
    }
    /**
    * @Route("/personne2/{id}", name="personne_show2")
    */
    public function showPersonne2(Personne $personne)
    {

        #$personne = $personneRepository->find($id);
        if (!$personne) {
            throw $this->createNotFoundException('Personne non trouvée avec l\'id '.$personne->id);
        }
        return $this->render('personne/index.html.twig', [
            'personne' => $personne,
            'adjectif' => 'recherchée'
        ]);
    }
    /**
    * @Route("/personne/{nom}/{prenom}", name="personne_show_one")
    */
    public function showPersonneByNomAndPrenom(string $nom, string $prenom, 
                                                PersonneRepository $personneRepository)
    {
        $personne = $personneRepository->findOneBy(["nom" => $nom,"prenom" => $prenom]);
        if (!$personne) {
            throw $this->createNotFoundException('Personne non trouvée');
        }
        return $this->render('personne/index.html.twig', [
            'personne' => $personne,
            'adjectif' => 'recherchée'
            ]);
    }
    /**
    * @Route("/personnes/show", name="personne_show_all")
    */
    public function showAllPersonne(PersonneRepository $personneRepository)
    {
        $personnes = $personneRepository->findAll();
        if (!$personnes) {
            throw $this->createNotFoundException('La table est vide');
        }
        return $this->render('personne/showAll.html.twig', ['personnes' => $personnes]);
    }
    /**
    * @Route("/personnes/{sexe}", name="personnes_show_by_sexe")
    */
    public function ShowPersonneBySexe(string $sexe, 
                                                PersonneRepository $personneRepository)
    {
        $personnes = $personneRepository->findBy(["sexe" => $sexe]);
        if (!$personnes) {
            throw $this->createNotFoundException('Personne non trouvée');
        }
        return $this->render('personne/showAll.html.twig', ['personnes' => $personnes]);
    }
}
