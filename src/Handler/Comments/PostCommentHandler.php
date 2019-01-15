<?php


namespace App\Handler\Comments;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;

class PostCommentHandler
{
    /**
     * @var UserRepository
     */
    private $userRepo;

    /**
     * @var CommentRepository
     */
    private $commentRepo;

    /**
     * PostCommentHandler constructor.
     * @param UserRepository $userRepo
     * @param CommentRepository $commentRepo
     */
    public function __construct(
        UserRepository $userRepo,
        CommentRepository $commentRepo
    ){
        $this->userRepo = $userRepo;
        $this->commentRepo = $commentRepo;
    }

    /**
     * @param array $data
     */
    public function handle(array $data)
    {
        $comment = new Comment();
        $comment->setBlog($data['post_id']);
        $comment->setAuthor($this->userRepo->getUserByID($data['author_id']));
        $comment->setComment($data['comment']);

        $this->commentRepo->saveWpersist($comment);
    }

}