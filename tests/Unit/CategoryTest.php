<?php

namespace Tests\Unit;

use App\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * Class CategoryTest.
 */
class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var
     */
    protected $category;

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
