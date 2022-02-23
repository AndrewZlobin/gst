<?php

namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BaseMainActivityGenerator
{
    protected int $id;

    private string $type;
    private string $header;
    private string $description;

    protected array $data = [];

    private UrlGeneratorInterface $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return BaseMainActivityGenerator
     */
    protected function setId(int $id): BaseMainActivityGenerator
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return BaseMainActivityGenerator
     */
    public function setType(string $type): BaseMainActivityGenerator
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getHeader(): string
    {
        return $this->header;
    }

    /**
     * @param string $header
     * @return BaseMainActivityGenerator
     */
    public function setHeader(string $header): BaseMainActivityGenerator
    {
        $this->header = $header;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return BaseMainActivityGenerator
     */
    public function setDescription(string $description): BaseMainActivityGenerator
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->router->generate('view_activity', [
            'id' => $this->getId()
        ]);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return BaseMainActivityGenerator
     */
    public function setData(array $data): BaseMainActivityGenerator
    {
        $this->data = $data;

        return $this;
    }

    public function generate(): array
    {
        return [
            'extracontainerclasses' => BlocksForMainActivitiesPage::WRAPPER_CLASS,
            'type' => $this->getType(),
            'header' => $this->getHeader(),
            'description' => $this->getDescription(),
            'route' => $this->getRoute(),
            'data' => $this->getData()
        ];
    }
}