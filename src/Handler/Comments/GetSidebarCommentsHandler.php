<?php

namespace App\Handler\Comments;


use App\Repository\CommentRepository;

class GetSidebarCommentsHandler
{
    /**
     * @var CommentRepository
     */
    private $commentRepo;

    /**
     * GetSidebarCommentsHandler constructor.
     * @param CommentRepository $commentRepo
     */
    public function __construct(
        CommentRepository $commentRepo
    ){
        $this->commentRepo = $commentRepo;
    }

    /**
     * @return \App\Entity\Comment[]|array
     */
    public function handle()
    {
        $comments = $this->commentRepo->getCommentsForHomepage();

        return $comments;
    }
}