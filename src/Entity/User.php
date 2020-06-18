<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity()
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", name="id", nullable=false)
     * @var integer $uid
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $name;

    /**
     * nullable na true mówi o tym, że nazwisko może być nullem
     * @ORM\Column(type="string", nullable=true)
     * @var string|null
     */
    private $surname;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @var Category
     */
    private $category;

    /**
     * User constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $surname
     */
    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }


}