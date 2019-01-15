<?php

namespace App\Handler\Comments;


use App\Repository\CommentRepository;

class GetPostCommentsHandler
{
    /**
     * @var CommentRepository
     */
    private $commentRepo;

    /**
     * GetPostCommentsHandler constructor.
     * @param CommentRepository $commentRepo
     */
    public function __construct(
        CommentRepository $commentRepo
    ){
        $this->commentRepo = $commentRepo;
    }

    /**
     * @param int $id
     * @return \App\Entity\Comment[]|array
     */
    public function handle(int $id)
    {
        $comments= $this->commentRepo->getCommentsForBlog($id);

        return $comments;
    }
}