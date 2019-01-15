<?php

namespace App\Handler\Posts;

use App\Handler\Comments\DeleteCommentsHandler;
use App\Repository\BlogRepository;

class DeletePostsHandler
{
    private $blogRepo;
    private $deleteCommentsHandler;

    public function __construct(
        BlogRepository $blogRepo,
        DeleteCommentsHandler $deleteCommentsHandler
    ){
        $this->blogRepo = $blogRepo;
        $this->deleteCommentsHandler = $deleteCommentsHandler;
    }

    /**
     * @param int $id ID of post to be deleted
     */
    public function handle(int $id): void
    {
        $blog = $this->blogRepo->findBlogById($id);
        $this->blogRepo->remove($blog);

        $this->deleteCommentsHandler->handle($id);
    }
}