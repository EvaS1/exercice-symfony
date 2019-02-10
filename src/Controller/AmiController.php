<?php
// le namespace des controllers sera toujours le même
namespace App\Controller;

// La classe Response nous sert pour renvoyer la réponse (voir après)
use Symfony\Component\HttpFoundation\Response;
// la classe Controller est la classe mère de tous les controllers
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Ami;
use App\Entity\Ville;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AmiType;



// notre controller doit forcément hériter de la classe Controller ("use" ci-dessus)
// Le nom de la classe doit être exactement le même que celui du fichier
class AmiController extends Controller
{

    
    /*Suppression ami depuis url*/
    public function index_delete_ami($id) {
    	$em = $this->getDoctrine()->getManager();
    	$ami = $em->getRepository(Ami::class)->find($id);
        $em->remove($ami);
		$em->flush();
    } 

    /*Récupération amis*/
    public function index() {
    	$repo = $this->getDoctrine()->getRepository(Ami::class);
        $tableau_amis = $repo ->findAll();
        return $this->render('ami.html.twig', array(
            "tableau_amis" => $tableau_amis
		));
    }


    /*Formulaire de création d'un ami*/
    public function new(Request $request) {


        //Création d'une entité Ville
        $ville = new Ville();   

        //Création d'une entité Ami
        $ami = new Ami();

        //On récupère la ville d'un ami
        $nomVille = $ami->getVille()->getNomVille();

        // Création du formulaire
        $form = $this->createForm(AmiType::class, $ami, ['action_name' => 'new'], $nomVille);

        $form->handleRequest($request);


        //Si nous venons de valider le formulaire et s'il est valide 
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ami);
            $em->persist($nomVille);
            $em->flush();

            //On redirige l'utilisateur vers la route /ami
            return $this->redirectToRoute('ami_recupere_index');
        }


        //On envoie vers Twig
        return $this->render('ami/new.html.twig', array(
            'form' => $form->createView(),
        ));

    }


    /*Formulaire de modification des amis*/
    public function modify($id, Request $request) {

        $repo = $this->getDoctrine()->getRepository(Ami::class);
        
        //On récupère l'ami grâce à son id
        $amiedit = $repo->find($id);


        //Création du formulaire
        $form = $this->createForm(AmiType::class, $amiedit, 
        ['action_name' => 'modify']);

        $form->handleRequest($request); 

        //Si nous venons de valider le formulaire et s'il est valide
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($amiedit);
            $em->flush();

        }
        
        //On envoie vers Twig
        return $this->render('ami/modify.html.twig', array(
            'form' => $form->createView(),
            'amiedit' => $amiedit
        ));

    }
        
}

?>