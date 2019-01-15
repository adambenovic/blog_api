<?php

namespace App\Handler\Posts;


use App\Repository\BlogRepository;
use Symfony\Component\HttpFoundation\Request;

class GetSearchPostsHandler
{
    /**
     * @var BlogRepository $blogRepo
     */
    private $blogRepo;

    /**
     * GetSearchPostsHandler constructor.
     * @param BlogRepository $blogRepo
     */
    public function __construct(
        BlogRepository $blogRepo
    ){
        $this->blogRepo = $blogRepo;
    }

    /**
     * @param Request $request
     * @return \App\Entity\Blog[]|array
     */
    public function handle(Request $request)
    {
        $blogs = $this->blogRepo->searchBlogs($request->get('q'));

        return $blogs;
    }
}