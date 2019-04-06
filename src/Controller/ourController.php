<?php
namespace  App\Controller;

use App\Entity\Currency;

//requirements
use Symfony\Component\HttpFoundation\Response;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


//create ourController
class ourController extends Controller{

  /**
    * @Route("/", name="home")
    * @Method({"GET"})
  **/

  public function index(){
    $currencies = $this->getDoctrine()->getRepository(Currency::class)->findAll();

    return $this->render('pages/index.html.twig', array("currencies" => $currencies));
  }
  /**
    * @Route("/login", name="login")
    * @Method({"GET", "POST"})
    */

  public function login(AuthenticationUtils $authenticationUtils){

      // get the login error if there is one
      $error = $authenticationUtils->getLastAuthenticationError();

      // last username entered by the user
      $lastUsername = $authenticationUtils->getLastUsername();

      return $this->render('pages/login.html.twig', [
          'last_username' => $lastUsername,
          'error'         => $error,
      ]);
  }

  /**
    * @Route("/admin", name="admin")
    * @Method({"GET", "POST"})
  **/

  public function adminPage(Request $request, ValidatorInterface $validator){
    $currency = new Currency();

    // form creation
    $form = $this->createFormBuilder($currency)
            ->add("name", TextType::class, array("attr" => array("class" => "form-control admin-form")))
            ->add("save", SubmitType::class, array("label" => "Add", "attr" => array("class" => "btn btn-primary btn-add")))
            ->getForm();

      $form->handleRequest($request);

      //get data from the form to database
      if($form->isSubmitted() && $form->isValid()){
        $currency = $form->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($currency);
        $entityManager->flush();

        return $this->redirectToRoute("admin");
      }

      $currencies = $this->getDoctrine()->getRepository(Currency::class)->findAll();

       return $this->render('pages/admin.html.twig', array("form" => $form->createView(), "currencies" => $currencies));
  }
  /**
    * @Route("/delete/{id}", name="delete")
    * @Method({"DELETE"})
  **/
  public function delete(Request $request, $id){

    //delete from database
    $currency = $this->getDoctrine()->getRepository(Currency::class)->find($id);
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($currency);
    $entityManager->flush();

    $response = new Response();
    $response->send();

  }

  /**
    * @Route("/logout", name="logout")
    * @Method({"GET"})
  **/
    
}

?>
