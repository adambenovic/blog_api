<?php

namespace App\Decorator;


use App\Entity\Blog;

class PostsDecorator
{
    public function decorate(Blog $post)
    {
        return [
            'id' => $post->getId(),
            'author' => $post->getAuthor()->getUsername(),
            'author_id' => $post->getAuthor()->getId(),
            'title' => $post->getTitle(),
            'body' => $post->getBlog(),
            'tags' => $post->getTags(),
            'created' => $post->getCreated(),
            'updated' => $post->getUpdated()
        ];
    }

    /**
     * @param array $posts
     * @return array|null
     */
    public function decorateMultiplePosts(array $posts)
    {
        $result = null;

        foreach ($posts as $post) {
            $result[] = $this->decorate($post);
        }

        return $result;
    }

    public function decorateSinglePost($post): array
    {
        return $this->decorate($post);
    }
}