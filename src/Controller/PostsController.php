<?php

namespace App\Controller;

use App\Decorator\PostsDecorator;
use App\Enum\HttpCode;
use App\Handler\Posts\DeletePostsHandler;
use App\Handler\Posts\GetPostsHandler;
use App\Handler\Posts\GetSearchPostsHandler;
use App\Handler\Posts\GetUserPostsHandler;
use App\Handler\Posts\PostPostHandler;
use App\Handler\Posts\PutPostHandler;
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
    private $deletePostsHandler;
    private $putPostHandler;
    private $getUserPostsHandler;
    private $getSearchPostsHandler;

    public function __construct(
        GetPostsHandler $getPostsHandler,
        PostsDecorator $postsDecorator,
        PostPostHandler $postPostHandler,
        DeletePostsHandler $deletePostsHandler,
        PutPostHandler $putPostHandler,
        GetUserPostsHandler $getUserPostsHandler,
        GetSearchPostsHandler $getSearchPostsHandler
    ){
        $this->getPostsHandler = $getPostsHandler;
        $this->postsDecorator = $postsDecorator;
        $this->postPostHandler = $postPostHandler;
        $this->deletePostsHandler = $deletePostsHandler;
        $this->putPostHandler = $putPostHandler;
        $this->getUserPostsHandler = $getUserPostsHandler;
        $this->getSearchPostsHandler = $getSearchPostsHandler;
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
        $data = $data['data'];
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
        $this->deletePostsHandler->handle($id);
        return new JsonResponse(null, HttpCode::HTTP_CODE_NO_CONTENT);
    }

    /**
     * @Route("", methods={"PUT"})
     * @param Request $request The request
     * @return JsonResponse
     */
    public function putPost(Request $request) : JsonResponse
    {
        $requestContent = $request->getContent();
        $data = json_decode($requestContent, true);
        $data = $data['data'];
        $this->putPostHandler->handle($data);
        return new JsonResponse(null, HttpCode::HTTP_CODE_NO_CONTENT);
    }

    /**
     * @Route("/user/{id}", methods={"GET"}, requirements={"id"="\d+"})
     * @param int $id
     * @return JsonResponse
     */
    public function getUserPosts(int $id) : JsonResponse
    {
        $posts = $this->getUserPostsHandler->handle($id);

        return new JsonResponse(
            ['data' => $this->postsDecorator->decorateMultiplePosts($posts)]
        );
    }

    /**
     * @Route("/search", methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getSearchPosts(Request $request) : JsonResponse
    {
        $posts = $this->getSearchPostsHandler->handle($request);

        return new JsonResponse(
            ['data' => $this->postsDecorator->decorateMultiplePosts($posts)]
        );
    }
}