<?php

namespace App\Controller;

use App\Entity\Shopcart;
use App\Form\ShopcartType;
use App\Repository\ShopcartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/shopcart")
 */
class ShopcartController extends AbstractController
{
    /**
     * @Route("/", name="shopcart_index", methods="GET")
     */
    public function index(ShopcartRepository $shopcartRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user=$this->getUser();

        $em=$this->getDoctrine()->getManager();
        $sql="SELECT p.title,p.sprice,s.*
              FROM shopcart s,product p
              WHERE s.productid=p.id and userid=:userid";
        $statement=$em->getConnection()->prepare($sql);
        $statement->bindValue('userid', $user->getid());
        $statement->execute();
        $shopcart=$statement->fetchAll();
        $this->addFlash('success','Sipariş Alınmıştır.');
        return $this->render('shopcart/index.html.twig', [
            'shopcarts' =>$shopcart]
        );
    }

    /**
     * @Route("/new", name="shopcart_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $shopcart = new Shopcart();
        $form = $this->createForm(ShopcartType::class, $shopcart);
        $form->handleRequest($request);

        $submittedToken=$request->request->get('token');

        if ($form->isSubmitted() ) {
            $em = $this->getDoctrine()->getManager();
            //$request->request->getManager();
            $user=$this->getUser();
            //$shopcart->setQuantity($request->request->get('quantity'));
            $shopcart->setUserid($user->getid());


            $em->persist($shopcart);
            $em->flush();
            return $this->redirectToRoute('shopcart_index');
        }

        return $this->render('shopcart/new.html.twig', [
            'shopcart' => $shopcart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shopcart_show", methods="GET")
     */
    public function show(Shopcart $shopcart): Response
    {
        return $this->render('shopcart/show.html.twig', ['shopcart' => $shopcart]);
    }

    /**
     * @Route("/{id}/edit", name="shopcart_edit", methods="GET|POST")
     */
    public function edit(Request $request, Shopcart $shopcart): Response
    {
        $form = $this->createForm(ShopcartType::class, $shopcart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shopcart_index', ['id' => $shopcart->getId()]);
        }

        return $this->render('shopcart/edit.html.twig', [
            'shopcart' => $shopcart,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/del", name="shopcart_del", methods="GET|POST")
     */
    public function del(Request $request, Shopcart $shopcart): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($shopcart);
        $em->flush();
        return $this->redirectToRoute('shopcart_index');
        $this->addFlash('success','Ürün  Silindi');
    }

    /**
     * @Route("/{id}", name="shopcart_delete", methods="DELETE")
     */
    public function delete(Request $request, Shopcart $shopcart): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shopcart->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($shopcart);
            $em->flush();
        }

        return $this->redirectToRoute('shopcart_index');
    }
}
