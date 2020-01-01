<?php

namespace App\Controller;
use App\Entity\Annonce;
use App\Entity\Category;
use App\Form\AnnonceType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AnnonceController extends AbstractController
{
    /**
     * @Route("/", name="list-annonce")
     */
    public function index()
    {
        $rep = $this->getDoctrine()->getRepository(Annonce::class);
        $annonces = $rep->findAll();
        return $this->render('annonce/index.html.twig', [
            "home" => 'Le petit coin',
            "annonces" => $annonces
        ]);

    }

    /**
 * @Route("/details/{id}", name="details")
 *
 */
    public function details($id){

        $rep=$this->getDoctrine()->getRepository(Annonce::class);
        $annonce=$rep->find($id);
        return $this->render('annonce/details.html.twig',[
            "home" => 'Le petit coin',
            'details' => $annonce

        ]);
    }
    /**
     * @Route("/category", name="category")
     *
     */
    public function category(){

        $rep=$this->getDoctrine()->getRepository(Annonce::class);
        $category =$rep->findBy('');
        return $this->render('annonce/category.html.twig',[
            "home" => 'Le petit coin',
            'cat' => $category

        ]);
    }


    /**
     * @Route("/depot", name="depot")
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @param null $id
     */
    public function create(Request $request, $id=null):Response
    {

        $depot= new Annonce();
        $depot -> setCreatedAt(new \DateTime());
        $form = $this->createForm(AnnonceType::class, $depot);

        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid() ) {



            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['photo']->getData();

            if ($uploadedFile){

                $newFileName = uniqid('photo_').'.'. $uploadedFile->guessExtension();

                $uploadedFile->move(
                    $this->getParameter('photo_path'),
                    $newFileName
                );

                $depot->setPhoto($newFileName);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($depot);
            $entityManager->flush();

            return $this->redirectToRoute('list-annonce');
        }
        return $this->render('annonce/depot.html.twig', [
            'home'=> 'Le petit coin',
            'formdepot' => $form->createView(),
        ]);
    }
}
