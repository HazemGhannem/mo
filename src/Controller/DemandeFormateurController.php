<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\DemandeFormateurRepository;
use App\Entity\DemandeFormateur;
use App\Entity\CV;
use App\Repository\CVRepository;

use Doctrine\ORM\Query\Parameter;
use App\Form\DemandeFType;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Smalot\PdfParser\Parser;
use Dompdf\Dompdf;
use Dompdf\Options;
use Mediumart\Orange\SMS\SMS;
use Mediumart\Orange\SMS\Http\SMSClient;
use Knp\Component\Pager\PaginatorInterface;

class DemandeFormateurController extends AbstractController
{
    
    /**
     * @Route("/demande/formateur/new", name="Adddemandeformateur")
     * Method({"GET","POST"})
     */    
    public function Add(Request $request): Response
    {
        $demandeformateur = new DemandeFormateur();
        $form =$this->createForm(DemandeFType::class,$demandeformateur);
        $form->handleRequest($request);
        $this->addFlash('success','Demande envoyé avec succés!');

        if($form->isSubmitted() && $form->isValid())
        {
           
            $file = $form->get('CV')->getData();
            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('uploads_directory'),$filename);
            $demandeformateur->setCv($filename);

            
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($demandeformateur);
            $entityManager->flush();
            $response=$this->forward('App\Controller\CVController::ajoutcv',['CV'=>$filename,'demandeformateur'=>$demandeformateur]);
           //usercontroller:$response=$this->forward('App\Controller\CVController::ajoutcv',['CV'=>$filename,'user'=>$user]);
           $client = SMSClient::getInstance('nEoxkRRL52MtHzUNAoaXc0ngnNVl9KDC', 'zSB1YIu2CSwoLnBL');
           $sms = new SMS($client);
           $sms->message("votre demande a été envoyé avec succès et va être traitée dans les plus bref délais. Merci de nous vous remercions de nous avoir choisi! ")
               ->from('+21651464577')
               
               ->to("+21652585099")
               ->send();
           return $this->redirectToRoute('list_demande_formateur');     
           
            //$serializer = new Serializer([new ObjectNormalizer()]);
            //$formatted= $serializer->normalize($demandeformateur);
           // return new JsonResponse($formatted);

        }
        
        return $this->render('demandeFormateur/addDemandeFormateur.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
    * @Route("/listu1", name="listu1", methods={"GET"})
    */
   public function listu1(CVRepository $CVRepository)
   {
       // Configure Dompdf according to your needs
       $pdfOptions = new Options();
       $pdfOptions->set('defaultFont', 'Arial');

       // Instantiate Dompdf with our options
       $dompdf = new Dompdf($pdfOptions);
       // Retrieve the HTML generated in our twig file
       $html = $this->renderView('cv\pdf.html.twig', [
           'demandeformateur' => $CVRepository->findAll(),
       ]);
       // Load HTML to Dompdf
       $dompdf->loadHtml($html);

       // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
       $dompdf->setPaper('A2', 'portrait');

       // Render the HTML as PDF
       $dompdf->render();
       // Output the generated PDF to Browser (inline view)
       $dompdf->stream("mypdf.pdf", [
           "Attachment" => false
       ]);
   }

    /**
     * @Route("/demande/formateur/list", name="list_demande_formateur")
     */
    public function list(Request $request ,PaginatorInterface $paginator): Response
    {
        $form=$this->getDoctrine()->getRepository(DemandeFormateur::class)
        ->findAll();
        $form = $paginator->paginate(
            $form, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            1 /*limit per page*/
        );
        //$serializer = new Serializer([new ObjectNormalizer()]);
        //$formatted= $serializer->normalize($form);
        //return new JsonResponse($formatted);
        return $this->render('demandeformateur/listDemandeFormateur.html.twig', [
            'form' => $form,
        ]);
    }    
    /**
     * @Route("/demande/formateur/Delete/{id}" , name="Delete_formateur")
     *Method({"DELETE"})
     */

    public function Delete(Request $request,$id)
    {
            $demandeformateur = $this->getDoctrine()
            ->getRepository(DemandeFormateur::class)
            ->find($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($demandeformateur);
            $entityManager->flush();

           // $serializer = new Serializer([new ObjectNormalizer()]);
            //$formatted= $serializer->normalize("Demande supprimée!");
            //return new JsonResponse($formatted);
            return $this->redirectToRoute('list_demande_formateur');     
    }

    /**
    * @Route("/demnade/formateur/download/{id}", name="download_file")
    **/
    public function downloadFileAction($id)
    {
            $demandeformateur = $this->getDoctrine()
            ->getRepository(DemandeFormateur::class)
            ->find($id);
            $var='uploads/'. $demandeformateur->getCV();
            (string)$var;
            $response = new BinaryFileResponse($var);
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT);
            return $response;
    }

    /**
    * @return Response
    * @Route ("/home" , name="home")
    */
    public function home()
    {
        return $this->render('home.html.twig');
        }
    
   
}
