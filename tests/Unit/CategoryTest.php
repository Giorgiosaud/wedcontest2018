<?php

namespace Tests\Unit;

use App\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class CategoryTest
 * @package Tests\Unit
 */
class CategoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var
     */
    protected $category;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->category = create(Category::class);
    }
    /**
     * @test
     */
    public function a_category_belongs_to_a_contest()
    {
        $this->assertInstanceOf(\App\Contest::class, $this->category->contest);
    }
}
