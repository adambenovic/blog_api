<?php

namespace App\Factory;

use App\Entity\Comment;
use App\Entity\Contact;
use App\Repository\BlogRepository;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Security;
use App\Entity\Blog;

class EntityFactory
{
    private $security;
    private $userRepo;
    private $blogRepo;

    public function __construct(
        Security $security,
        UserRepository $userRepo,
        BlogRepository $blogRepo
    ){
        $this->security = $security;
        $this->userRepo = $userRepo;
        $this->blogRepo = $blogRepo;
    }

    /**
     * @param array $data Request data
     * @return Blog new Blog object with Author set
     */
    public function createBlogPost(array $data): Blog
    {
        $blog = new Blog();
        $blog->setAuthor($this->userRepo->getUserByID($data['author_id']));
        $blog->setBlog($data['body']);
        $blog->setTitle($data['title']);
        $blog->setTags($data['tags']);

        return $blog;
    }

    /**
     * @param array $data
     * @return object|null
     */
    public function editBlogPost(array $data)
    {
        $blog = $this->blogRepo->find($data['id']);
        $blog->setBlog($data['body']);
        $blog->setTitle($data['title']);
        $blog->setTags($data['tags']);
        $updated = null;
        try
        {
            $updated = new \DateTime('now');
        }
        catch (\Exception $exception){
            echo "Our time is...failed.";
        }
        $blog->setUpdated($updated);

        return $blog;
    }

    /**
     * @param Blog $blog The post that is the comment associated to
     * @return Comment new Comment object
     */
    public function createComment(Blog $blog): Comment
    {
        $comment = new Comment();
        $comment->setBlog($blog);
        $user = $this->security->getUser();
        if(null != $user)
            $comment->setAuthor($user);

        return $comment;
    }

    /**
     * @return Contact new Cotact object
     */
    public function createContact(): Contact
    {
        $contact = new Contact();

        return $contact;
    }
}