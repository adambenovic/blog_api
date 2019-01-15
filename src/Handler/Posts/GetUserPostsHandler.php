<?php
/**
 * Created by PhpStorm.
 * User: adam.benovic
 * Date: 15. 1. 2019
 * Time: 9:52
 */

namespace App\Handler\Posts;


use App\Repository\BlogRepository;
use App\Repository\UserRepository;

class GetUserPostsHandler
{
    private $blogRepo;
    private $userRepo;

    public function __construct(
        BlogRepository $blogRepo,
        UserRepository $userRepo
    ){
        $this->blogRepo = $blogRepo;
        $this->userRepo = $userRepo;
    }

    public function handle(int $id)
    {
        $user = $this->userRepo->getUserByID($id);
        $blogs = $this->blogRepo->findUserBlogs($user);

        return $blogs;
    }

}