<?php


namespace App\Service;

class CustomersFeedbackGenerator
{
    const IDENTIFIER = 'customersfeedback';
    const WRAPPER_CLASS = 'bg-transparent';

    const PREFIX = 'feedback-';
    const MAX_FEEDBACKS = 7;

    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    public function getFeedbacksData(): array
    {
        return [
            'header' => 'Отзывы наших заказчиков',
            'caption' => '<span class="font-weight-semi-bold">ООО «Газстройтех»</span> имеет опыт выполнения робот, 
            а также опыт проведения инженерных изысканий, 
            разработки технико-экономических обоснований строительства, 
            подготовки проектной документации для нужд компаний Группы «Газпром».',
            'feedbacks' => $this->getFeedbacks(),
        ];
    }

    public function getFeedbacks(): array
    {
        $feedbacks = [];

        for ($i = 1; $i < self::MAX_FEEDBACKS; $i++) { 
            $feedbacks[] = 'feedback-' . $i;
        }

        return $feedbacks;
    }
}