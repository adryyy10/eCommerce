<?php

namespace App\Tests\Product;

use App\Controller\Product\GetController;
use App\Interfaces\Product\ProductRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class GetControllerTest extends TestCase
{

    public array $mocks;

    protected function setUp(): void
    {
        parent::setUp();
        $this->initMocks();
    }

    public function initMocks()
    {
        $this->mocks[ProductRepositoryInterface::class] = $this->createMock(ProductRepositoryInterface::class);
        $this->mocks[GetController::class]              = $this->createMock(GetController::class);
        $this->mocks[Response::class]                   = $this->createMock(Response::class);
    }

    public function testGetProducts()
    {
        $this->mocks[ProductRepositoryInterface::class]
            ->expects($this->once())
            ->method('findAll')
            ->willReturn([]);

        $response = $this->mocks[GetController::class]
            ->expects($this->once())
            ->method('getProducts')
            ->willReturn($this->mocks[Response::class]);
    }

}
