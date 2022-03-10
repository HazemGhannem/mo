<?php

namespace App\Controller;
use App\Entity\CV;
use App\Entity\DemandeFormateur;
use App\Form\CVType;
use App\Repository\CVRepository;
use App\Repository\DemandeFormateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Smalot\PdfParser\Parser;
use Dompdf\Dompdf;
use Dompdf\Options;


class CVController extends AbstractController
{
    /**
     * @Route("/cv", name="cv")
     */
    public function ajoutcv($CV, $demandeformateur): Response
    {   
        $cv=new CV();
        $cv->setCVusers($CV);
        $cv->setExperience('jnnj');
        $cv->setFormation('njnn');
        $cv->setDemandeformateur($demandeformateur);
        //$cv->setDemandeformateur($user);
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($cv);
        $entityManager->flush();
        return $this->redirectToRoute('list_demande_formateur');
    }

    /**
     * @Route("/cv/extract", name="extract")
     */
    public function extract(): Response
    {   
        
        // Parse pdf file and build necessary objects.
        $parser = new \Smalot\PdfParser\Parser();
        $CV = $parser->parseFile('C:\Users\lenovo\Desktop\papiers\CV\CVmolkahchaichi.pdf');
 
        // Retrieve all pages from the pdf file.
        $details = $CV->getDetails();
        $pages  = $CV->getPages();
 
        // Loop over each page to extract text.
        foreach ($pages as $page) {
        echo $page->getText();
        foreach ($details as $property => $value) {
            if (is_array($value)) {
                $value = implode(', ', $value);
            }
            echo $property . ' => ' . $value . "<br/>";
}
        return new Response();
}
}
    /**
     * @Route("/createcv", name="createcv")
     * Method({"GET","POST"})
     */ 
    public function newCV(Request $request): Response
    {
        $cv = new CV();
        $formA =$this->createForm(CVType::class,$cv);
        $formA->handleRequest($request);
        if($formA->isSubmitted() && $formA->isValid())
        {            
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($cv);
            $entityManager->flush();
           //usercontroller:$response=$this->forward('App\Controller\CVController::ajoutcv',['CV'=>$filename,'user'=>$user]);
            //$serializer = new Serializer([new ObjectNormalizer()]);
            //$formatted= $serializer->normalize($demandeformateur);
           // return new JsonResponse($formatted);
           return $this->redirectToRoute('listu1');

        }
    return $this->render('addcv.html.twig', [
        'formA' => $formA->createView(),
    ]);
}
   //  /**
    // * @Route("/listu1", name="listu1", methods={"GET"})
    // */
    //public function listu1(CVRepository $CVRepository)
   // {
     //   // Configure Dompdf according to your needs
       // $pdfOptions = new Options();
       // $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
       // $dompdf = new Dompdf($pdfOptions);
        // Retrieve the HTML generated in our twig file
       // $html = $this->renderView('cv\pdf.html.twig', [
         //   'cv' => $CVRepository->findAll(),
        //]);

        // Load HTML to Dompdf
        //$dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
   //     $dompdf->setPaper('A2', 'portrait');

        // Render the HTML as PDF
     //   $dompdf->render();
        // Output the generated PDF to Browser (inline view)
       // $dompdf->stream("mypdf.pdf", [
         //   "Attachment" => false
        //]);
    //}
        }
    
