<?php

namespace App\Controller;

use App\Entity\News;
use App\Entity\User;
use App\Entity\Comment;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/news')]
class NewsController extends AbstractController
{
    #[Route('/', name: 'app_news_index', methods: ['GET'])]
    public function index(NewsRepository $newsRepository): Response
    {
        return $this->render('news/index.html.twig', [
            'news' => $newsRepository->findAll(),
        ]);
    }



    #[Route('/new', name: 'app_news_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NewsRepository $newsRepository): Response
    {
        $news = new News();
        $user = $this->getUser();
        $news->setDateAdded(new \DateTime('now'));
        $news->setUser($user);
        $news -> setNumberOfViews(0);
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsRepository->add($news);
            return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('news/new.html.twig', [
            'news' => $news,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_news_show', methods: ['GET'])]
    public function show(News $news, UserRepository $userRepository, CommentRepository $commentRepository): Response
    {
        return $this->render('news/show.html.twig', [
            'news' => $news,
            'comments' => $commentRepository->findAll(),
            'users' => $userRepository->findAll()
        ]);
    }

    #[Route('/{id}/edit', name: 'app_news_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, News $news, NewsRepository $newsRepository): Response
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsRepository->add($news);
            return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('news/edit.html.twig', [
            'news' => $news,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_news_delete', methods: ['POST'])]
    public function delete(Request $request, News $news, NewsRepository $newsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$news->getId(), $request->request->get('_token'))) {
            $newsRepository->remove($news);
        }

        return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
