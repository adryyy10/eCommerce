<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Cache\Psr6\InvalidArgument;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity=Basket::class, mappedBy="products")
     */
    private $baskets;

    public function __construct(
        string $name, 
        string $description, 
        float $price
    ) {
        $this->name         = $name;
        $this->description  = $description;
        $this->price        = $price;
        $this->baskets = new ArrayCollection();
    }

    /**
     * This method validates that the params are correct
     * 
     * @param string $name
     * @param string $description
     * @param float $price
     */
    private function validateBusinessLogic(
        string $name,
        string $description,
        float $price
    ) {
        if (empty($name) || strlen($name) < 3) {
            throw new InvalidArgumentException("Invalid name");
        }

        if (empty($description)) {
            throw new InvalidArgumentException("Invalid description");
        }

        if ($price <= 0) {
            throw new InvalidArgumentException("Invalid price");
        }
    }

    /**
     * This method returns a self entity
     * 
     * @param string $name
     * @param string $description
     * @param float $price
     * 
     * @return Product
     */
    public static function create(
        string $name,
        string $description,
        float $price
    ): self {

        /** Create a new instance of the entity */
        $product = new self($name, $description, $price);

        /** Validate all params are correct according with our business logic */
        $product->validateBusinessLogic($name, $description, $price);

        /** Set the internal values of the Product only inside of it, not in other files, trying to follow a more DDD approach */
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice($price);

        return $product;
    }

    public static function update(
        Product $product, 
        string $name,
        string $description,
        float $price
    ): self {

        /** Validate all params are correct according with our business logic */
        $product->validateBusinessLogic($name, $description, $price);

        /** Set the internal values of the Product only inside of it, not in other files, trying to follow a more DDD approach */
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice($price);

        return $product;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    private function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    private function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    private function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Basket>
     */
    public function getBaskets(): Collection
    {
        return $this->baskets;
    }

    public function addBasket(Basket $basket): self
    {
        if (!$this->baskets->contains($basket)) {
            $this->baskets[] = $basket;
            $basket->addProduct($this);
        }

        return $this;
    }

    public function removeBasket(Basket $basket): self
    {
        if ($this->baskets->removeElement($basket)) {
            $basket->removeProduct($this);
        }

        return $this;
    }
}
