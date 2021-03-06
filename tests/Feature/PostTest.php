<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Comment;
use Database\Factories\CommentFactory;
use Database\Factories\BlogPostFactory;
//use Illuminate\Foundation\Testing\WithFaker; 이거는 뭔데 지웠지?
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No posts found!');
    }

    public function testSee1BlogPostWhenThereIs1WithNoComments()
    {
        // Arrage
        $post = $this->createDummyBlogPost();

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('New title');
        $response->assertSeeText('No comments yet');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
    }

    public function testSee1BlogPostWithComments()
    {
        //Arrange [given]
        $post = $this->createDummyBlogPost();
        $factory = new CommentFactory();

        $factory->create([
            'blog_post_id' => $post->id
        ]);
        //Act [when]
        $response = $this->get('/posts');
        //Assert [then]
        $response->assertSeeText(' 1 comments');
    }

    public function testStoreValid()
    {
        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was created!');
    }

    public function testStoreFail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');

    }

//    public function testUpdateValid()
//    {
//        $post = new BlogPost();
//        $post->title = 'New title';
//        $post->content = 'Content of the blog post';
//        $post->save();
//
//        $this->assertDatabaseHas('blog_posts', $post->toArray());
//
//        $params = [
//            'title' => 'A new named title',
//            'content' => 'Content was changed'
//        ];
//
//        $this->put("/posts/{$post->id}", $params)
//            ->assertStatus(302)
//            ->assertSessionHas('status');
//
//        $this->assertEquals(session('status'), 'Blog post was updated!');
//        $this->assertDatabaseMissing('blog_posts', $post->toArray());
//        $this->assertDatabaseHas('blog_posts', [
//            'title' => 'A new named title'
//        ]);
//    }

    public function testDelete()
    {
        $post = $this->createDummyBlogPost();

        $this->delete("/posts/{$post->id}")
        ->assertStatus(302)
        ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was delete!');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());

    }

    private function createDummyBlogPost(): BlogPost
    {
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'Content of the blog post';
        $post->save();
        return $post;


//        $factory = new BlogPostFactory();
//        return $factory->state('new-title')->create();

    }
}
