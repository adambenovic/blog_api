<?php

namespace App\Controller;

use App\Decorator\PostsDecorator;
use App\Enum\HttpCode;
use App\Handler\Posts\GetPostsHandler;
use App\Handler\Posts\PostPostHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/api/posts")
 */
class PostsController extends AbstractController
{
    private $getPostsHandler;
    private $postsDecorator;
    private $postPostHandler;

    public function __construct(
        GetPostsHandler $getPostsHandler,
        PostsDecorator $postsDecorator,
        PostPostHandler $postPostHandler
    ){
        $this->getPostsHandler = $getPostsHandler;
        $this->postsDecorator = $postsDecorator;
        $this->postPostHandler = $postPostHandler;
    }

    /**
     * @Route("", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function getAllPosts() : JsonResponse
    {
        $posts = $this->getPostsHandler->handleMultiple();
        return new JsonResponse(
            ['data' => $this->postsDecorator->decorateMultiplePosts($posts)]
        );
    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id"="\d+"})
     * @param int $id ID of the post to return
     * @return JsonResponse
     */
    public function getPostByID(int $id) : JsonResponse
    {
        $post = $this->getPostsHandler->handleSingle($id);
        return new JsonResponse(
            ['data' => $this->postsDecorator->decorateSinglePost($post)]
        );
    }

    /**
     * @Route("", methods={"POST"})
     * @param Request $request The request
     * @return JsonResponse
     */
    public function postPost(Request $request) : JsonResponse
    {
        $requestContent = $request->getContent();
        $data = json_decode($requestContent, true);
        $this->postPostHandler->handle($data);
        return new JsonResponse(null, HttpCode::HTTP_CODE_NO_CONTENT);
    }

    /**
     * @Route("/{id}", methods={"DELETE"}, requirements={"id"="\d+"})
     * @param int $id The ID of post to be deleted
     * @return JsonResponse
     */
    public function deletePost(int $id) : JsonResponse
    {
        $handler = $this->container->get(DeletePostHandler::class);
        $handler->handle($id);
        return new JsonResponse(null, HttpCode::HTTP_CODE_NO_CONTENT);
    }

    /**
     * @Route("/{id}", methods={"PUT"}, requirements={"id"="\d+"})
     * @param int $id The ID of post to be updated
     * @return JsonResponse
     */
    public function putPost(int $id) : JsonResponse
    {
        $handler = $this->container->get(PutPostHandler::class);
        $handler->handle($id);
        return new JsonResponse(null, HttpCode::HTTP_CODE_NO_CONTENT);
    }
}
