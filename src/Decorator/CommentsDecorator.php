<?php

namespace App\Decorator;


use App\Entity\Comment;

class CommentsDecorator
{
    public function decorate(Comment $comment)
    {
        return [
            'id' => $comment->getId(),
            'author' => $comment->getAuthor()->getUsername(),
            'author_id' => $comment->getAuthor()->getId(),
            'body' => $comment->getComment(),
            'created' => $comment->getCreated()
        ];
    }

    public function decorateMultipleComments(array $comments)
    {
        foreach ($comments as $comment) {
            $result[] = $this->decorate($comment);
        }

        return $result;
    }

}