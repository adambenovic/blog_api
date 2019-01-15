<?php

namespace App\Handler\Posts;

use App\Repository\BlogRepository;

class GetPostsHandler
{
    private $blogRepo;

    public function __construct(
        BlogRepository $blogRepo
    ){
        $this->blogRepo = $blogRepo;
    }

    public function handleMultiple(): array
    {
        $blogs = $this->blogRepo->loadBlogs();

        return $blogs;
    }

    public function handleSingle(int $id)
    {
        $blog = $this->blogRepo->find($id);

        return $blog;
    }
}