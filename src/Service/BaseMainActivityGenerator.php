<?php

namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BaseMainActivityGenerator
{
    protected string $type;
    protected array $data = [];

    private string $header;
    private string $description;

    private UrlGeneratorInterface $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
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
     */
    protected function setType(string $type)
    {
        $this->type = $type;
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
            'type' => $this->getType(),
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
     */
    public function setData(array $data): BaseMainActivityGenerator
    {
        $this->data = $data;

        return $this;
    }

    public function generateInfo(): array
    {
        return [
            $this->getType() => [
                'header' => $this->getHeader(),
                'description' => $this->getDescription(),
                'route' => $this->getRoute(),
            ]
        ];
    }

    public function generateData(): array
    {
        return [
            $this->getType() => [
                'header' => $this->getHeader(),
                'data' => $this->getData()
            ]
        ];
    }
}