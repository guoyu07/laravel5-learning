<?php
/**
 * Created by PhpStorm.
 * User: charles
 * Date: 10/19/16
 * Time: 16:33
 */

namespace App\Services;

use Closure;

class PostService
{
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * PostService constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return int
     */
    public function displayAllPosts()
    {
        return $this->getAllPosts(function (Post $post) {
            $txt = "{$post->id} : {$post->title}" . PHP_EOL;
            echo($txt);
        });
    }

    private function getAllPosts(Closure $closure)
    {
        $posts = $this->postRepository->getAllPosts();
        foreach ($posts as $post) {
            $closure($post);
        }
        return $posts->count();
    }
}

// class PostService
// {
//     /**
//      * @var PostRepository
//      */
//     private $postRepository;
//
//     /**
//      * PostService constructor.
//      * @param PostRepository $postRepository
//      */
//     public function __construct(PostRepository $postRepository)
//     {
//         $this->postRepository = $postRepository;
//     }
//
//     /**
//      * @return int
//      */
//     public function displayAllPosts()
//     {
//         $posts = $this->postRepository->getAllPosts();
//
//         foreach ($posts as $post) {
//             $txt = "{$post->id} : {$post->title}" . PHP_EOL;
//             echo($txt);
//         }
//
//         return $posts->count();
//     }
//
// }
