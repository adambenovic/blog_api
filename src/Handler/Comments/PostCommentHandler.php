<?php


namespace App\Handler\Comments;

use App\Entity\Comment;
use App\Repository\BlogRepository;
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
     * @var BlogRepository
     */
    private $blogRepo;

    /**
     * PostCommentHandler constructor.
     * @param UserRepository $userRepo
     * @param CommentRepository $commentRepo
     * @param BlogRepository $blogRepo
     */
    public function __construct(
        UserRepository $userRepo,
        CommentRepository $commentRepo,
        BlogRepository $blogRepo
    ){
        $this->userRepo = $userRepo;
        $this->commentRepo = $commentRepo;
        $this->blogRepo = $blogRepo;
    }

    /**
     * @param array $data
     */
    public function handle(array $data)
    {
        $comment = new Comment();
        $comment->setBlog($this->blogRepo->findBlogById($data['post_id']));
        $comment->setAuthor($this->userRepo->getUserByID($data['author_id']));
        $comment->setComment($data['comment']);

        $this->commentRepo->saveWpersist($comment);
    }

}