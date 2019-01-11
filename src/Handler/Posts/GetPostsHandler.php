<?php

namespace App\Handler\Posts;

use App\Service\DatabaseService;

class GetPostsHandler
{
    private $dbService;

    public function __construct(
        DatabaseService $dbService
    ){
        $this->dbService = $dbService;
    }

    public function handleMultiple(): array
    {
        return $this->dbService->loadHomepagePosts();
    }

    public function handleSingle(int $id)
    {
        return $this->dbService->loadShowPost($id);
    }
}