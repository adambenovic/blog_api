<?php

namespace App\Handler\Comments;


use App\Repository\CommentRepository;

class DeleteCommentsHandler
{
    /**
     * @var CommentRepository
     */
    private $commentRepo;

    /**
     * DeleteCommentsHandler constructor.
     * @param CommentRepository $commentRepo
     */
    public function __construct(
        CommentRepository $commentRepo
    ){
        $this->commentRepo = $commentRepo;
    }

    /**
     * @param int $id
     */
    public function handle(int $id)
    {
        $comments = $this->commentRepo->getCommentsForBlog($id);
        foreach ($comments as $comment) {
            $this->commentRepo->remove($comment);
        }
    }
}