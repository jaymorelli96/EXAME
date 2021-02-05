<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Courses
 *
 * @ORM\Table(name="courses", indexes={@ORM\Index(name="teacher_id", columns={"teacher_id"}), @ORM\Index(name="class_id", columns={"class_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\CoursesRepository")
 */
class Courses
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var int|null
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sales", type="integer", nullable=true)
     */
    private $sales;

    /**
     * @var \Classes
     *
     * @ORM\ManyToOne(targetEntity="Classes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="class_id", referencedColumnName="id")
     * })
     */
    private $class;

    /**
     * @var \Teachers
     *
     * @ORM\ManyToOne(targetEntity="Teachers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="teacher_id", referencedColumnName="id")
     * })
     */
    private $teacher;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSales(): ?int
    {
        return $this->sales;
    }

    public function setSales(?int $sales): self
    {
        $this->sales = $sales;

        return $this;
    }

    public function getClass(): ?Classes
    {
        return $this->class;
    }

    public function setClass(?Classes $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getTeacher(): ?Teachers
    {
        return $this->teacher;
    }

    public function setTeacher(?Teachers $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }


}
