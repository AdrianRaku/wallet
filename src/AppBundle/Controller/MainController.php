<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ReceiptItem;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/add")
     *
     * @return Response
     */
    public function addItemAction(){
        $entityManager= $this->getDoctrine()->getManager();

        $item = new ReceiptItem();

        $item->setName('Test');
        $item->setQuantity(2);
        $item->setReceiptId(1);
        $item->setDuty(22.5);

        $entityManager->persist($item);

        $entityManager->flush();
        return new Response("Dodano! ".$item->getName());
    }

    /**
     * @Route("/contact", name="contact")
     *
     * @return Response
     */
    public function contactAction(){
        return $this->render('main/contact.html.twig');
    }

    /**
     * @Route("/wallet", name="wallet")
     *
     * @return Response
     */
    public function walletAction(){
        $this->denyAccessUnlessGranted("ROLE_USER");
        $entityManager = $this->getDoctrine()->getManager();
        $user=$entityManager->getRepository(User::class)->findBy(["id" => $this->getUser()]);
        return $this->render('main/wallet.html.twig',["user" => $user]);
    }
}
