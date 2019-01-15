<?php

namespace App\Handler\Posts;


use App\Factory\EntityFactory;
use App\Repository\BlogRepository;

class PostPostHandler
{
    private $entityFactory;
    private $blogRepo;

    public function __construct(
        EntityFactory $entityFactory,
        BlogRepository $blogRepo
    ){
        $this->entityFactory = $entityFactory;
        $this->blogRepo = $blogRepo;
    }

    public function handle(array $data): void
    {
        $blog = $this->entityFactory->createBlogPost($data);
        $this->blogRepo->saveWpersist($blog);
    }
}