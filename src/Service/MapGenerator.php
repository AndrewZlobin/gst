<?php


namespace App\Service;

use Symfony\Contracts\Translation\TranslatorInterface;

class MapGenerator
{
    const IDENTIFIER = 'offices';
    const DEFAULT_WRAPPER_CLASS = 'map-custom-bg';

    const SAINT_PETERSBURG = 'spb';
    const MOSCOW = 'moscow';
    const UGORSK = 'ugorsck';
    const SARATOV = 'saratov';
    const URENGOY = 'urengoy';
    const ANAPA = 'anapa';

    const OFFICES = [
        self::SAINT_PETERSBURG,
        self::MOSCOW,
        self::UGORSK,
        self::SARATOV,
        self::URENGOY,
        self::ANAPA
    ];

    protected string $mapcaption = '';
    protected bool $usedefaultwrapper = false;

    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return string
     */
    public function getMapcaption(): string
    {
        return $this->mapcaption;
    }

    /**
     * @param string $mapcaption
     */
    public function setMapcaption(string $mapcaption): void
    {
        $this->mapcaption = $mapcaption;
    }

    /**
     * @return bool
     */
    public function isUsedefaultwrapper(): bool
    {
        return $this->usedefaultwrapper;
    }

    /**
     * @param bool $usedefaultwrapper
     */
    public function setUsedefaultwrapper(bool $usedefaultwrapper): void
    {
        $this->usedefaultwrapper = $usedefaultwrapper;
    }



    public function getIdentifier(): string
    {
        return self::IDENTIFIER;
    }

    public function getOfficesForMap(): array
    {
        $translationid = self::IDENTIFIER;

        $points = [];
        $points['points'] = $this->getOfficesData();
        $points['header'] = $this->translator->trans("${translationid}.header");

        if (!empty($this->getMapcaption())) {
            $points['caption'] = $this->getMapcaption();
        }

        if ($this->isUsedefaultwrapper()) {
            $points['extracontainerclasses'] = self::DEFAULT_WRAPPER_CLASS;
        }

        return $points;
    }
    
    protected function getOfficesData(): array
    {
        $officesdata = [];

        foreach (self::OFFICES as $office) {
            $officesdata[$office]['name'] = $this->translator->trans("offices.${office}.name");
            $officesdata[$office]['caption'] = $this->translator->trans("offices.${office}.caption");

            $officesdata[$office]['latitude'] = $this->returnOfficesCoordinates()[$office]['latitude'];
            $officesdata[$office]['longitude'] = $this->returnOfficesCoordinates()[$office]['longitude'];

            $officesdata[$office]['image'] = $office;
        }

        return $officesdata;
    }

    protected function returnOfficesCoordinates(): array
    {
        return [
            self::SAINT_PETERSBURG => [
                'latitude' => 59.909427,
                'longitude' => 30.255771
            ],
            self::MOSCOW => [
                'latitude' => 55.655709,
                'longitude' => 37.551747
            ],
            self::UGORSK => [
                'latitude' => 61.313301,
                'longitude' => 63.310297
            ],
            self::SARATOV => [
                'latitude' => 51.513758,
                'longitude' => 45.999132
            ],
            self::URENGOY => [
                'latitude' => 66.077309,
                'longitude' => 76.612262
            ],
            self::ANAPA => [
                'latitude' => 44.990733,
                'longitude' => 37.249578
            ]
        ];
    }
}
