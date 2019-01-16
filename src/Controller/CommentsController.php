<?php

namespace App\Controller;

use App\Decorator\CommentsDecorator;
use App\Enum\HttpCode;
use App\Handler\Comments\GetPostCommentsHandler;
use App\Handler\Comments\GetSidebarCommentsHandler;
use App\Handler\Comments\PostCommentHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/comments", name="comments")
 */
class CommentsController extends AbstractController
{
    /**
     * @var CommentsDecorator
     */
    private $commentsDecorator;

    /**
     * @var GetSidebarCommentsHandler
     */
    private $getSidebarCommentsHandler;

    /**
     * @var GetPostCommentsHandler
     */
    private $getPostCommentsHandler;

    /**
     * @var PostCommentHandler
     */
    private $postCommentHandler;

    /**
     * CommentsController constructor.
     * @param CommentsDecorator $commentsDecorator
     * @param GetSidebarCommentsHandler $getSidebarCommentsHandler
     * @param GetPostCommentsHandler $getPostCommentsHandler
     * @param PostCommentHandler $postCommentHandler
     */
    public function __construct(
        CommentsDecorator $commentsDecorator,
        GetSidebarCommentsHandler $getSidebarCommentsHandler,
        GetPostCommentsHandler $getPostCommentsHandler,
        PostCommentHandler $postCommentHandler
    ){
        $this->commentsDecorator = $commentsDecorator;
        $this->getSidebarCommentsHandler = $getSidebarCommentsHandler;
        $this->getPostCommentsHandler = $getPostCommentsHandler;
        $this->postCommentHandler = $postCommentHandler;
    }

    /**
     * @Route("", methods={"GET"}, name="sidebar_comments")
     * @return JsonResponse
     */
    public function getSidebarComments()
    {
        $comments = $this->getSidebarCommentsHandler->handle();

        return new JsonResponse(
            ['data' => $this->commentsDecorator->decorateMultipleComments($comments)]
        );
    }

    /**
     * @Route("/{id}", methods={"GET"}, name="post_comments", requirements={"id"="\d+"})
     * @param int $id
     * @return JsonResponse
     */
    public function getPostComments(int $id)
    {
        $comments = $this->getPostCommentsHandler->handle($id);

        return new JsonResponse(
            ['data' => $this->commentsDecorator->decorateMultipleComments($comments)]
        );
    }

    /**
     * @Route("", methods={"POST"},name="post_comment")
     * @param Request $request
     * @return JsonResponse
     */
    public function postComment(Request $request)
    {
        $requestContent = $request->getContent();
        $data = json_decode($requestContent, true);
        $data = $data['data'];
        $this->postCommentHandler->handle($data);

        return new JsonResponse(null, HttpCode::HTTP_CODE_NO_CONTENT);
    }
}
