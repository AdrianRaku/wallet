<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Receipt;
use AppBundle\Entity\ReceiptItem;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\FloatType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\ReceiptItemType;


class ReceiptController extends Controller
{


    /**
     * @Route("/addItem", name="addItem")
     *
     * @param Request $request
     * @return Response
     */
    public function addItem(Request $request)
   {
        $session = new Session();
        $receipt=$session->get('receipt');
        if(!$itemArray = $session->get('itemArray'))
            $itemArray = new ArrayCollection();

        $receiptItem =  new ReceiptItem();
        $receiptItem->setReceiptId(0);
        $form=$this->createForm(ReceiptItemType::class, $receiptItem);
        $form->get('Quantity')->setData(3);
        $form->handleRequest($request);

       if($form->isValid())
           if($form->get('Add')->isClicked()){
               $receiptItem =$form->getData();
               $receiptItem->nr=sizeof($itemArray);
               $itemArray->add($receiptItem);
               $session->set('itemArray',$itemArray);
       }
        return $this->render('receipt/newReceipt.html.twig',[
            'form' => $form->createView(),
            'items' => $itemArray
        ]);

   }


    /**
     * @Route("/newReceipt", name="newReceipt")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Exception
     */
    public function newReceipt(Request $request)
    {
        $receipt = new Receipt();
        $receipt->setUser($this->getUser());
        $receipt->setCreatedAt(new \DateTime('now'));

        $session = new Session();
        $session->set('receipt', $receipt);

        return $this->redirectToRoute("addItem");
   }


    /**
     * @Route("/deleteReceiptItem/{id}", name="deleteReceiptItem")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @param $id
     */
    public function deleteReceiptItemAuction($id)
    {
        $session = new Session();
        $itemToRemove = null;
        $itemArray = $session->get('itemArray');
        foreach($itemArray as $item)
        {
            if($item->nr==$id)
                $itemArray->removeElement($item);
        }
        $session->set('itemArray', $itemArray);
        return $this->redirectToRoute("addItem");
   }
}