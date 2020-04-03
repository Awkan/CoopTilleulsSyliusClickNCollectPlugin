<?php

/*
 * This file is part of Les-Tilleuls.coop's Click 'N' Collect project.
 *
 * (c) Les-Tilleuls.coop <contact@les-tilleuls.coop>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace CoopTilleuls\SyliusClickNCollectPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;
use Sylius\Component\Shipping\Model\ShippingMethodInterface;

/**
 * {@inheritdoc}
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class Location implements LocationInterface
{
    use TimestampableTrait;
    use ToggleableTrait;

    /** @var mixed */
    protected $id;

    /**
     * @var string|null
     */
    protected $code = null;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string|null
     */
    protected $street = null;
    
    /**
     * @var string|null
     */
    protected $city = null;
    
    /**
     * @var string|null
     */
    protected $postcode = null;

    /**
     * @var string|null
     */
    protected $countryCode = null;

    /**
     * @var string|null
     */
    protected $provinceCode = null;

    /**
     * @var string|null
     */
    protected $provinceName = null;

    /**
     * @var string
     */
    protected $rrule = 'FREQ=MINUTELY;INTERVAL=20;BYHOUR=9,10,11,12,13,14,15,16;BYDAY=MO,TU,WE,TH,FR;DTSTART=20200328T080000;DTEND=20200328T082000';

    /**
     * @var int
     */
    protected $orderPreparationDelay = 0;
    
    /**
     * @var int
     */
    protected $throughput = 1;

    /**
     * @var bool
     */
    protected $generatePin = false;
    /**
     * @var ShippingMethodInterface[]|Collection
     */
    protected $shippingMethods;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->shippingMethods = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function getProvinceCode(): ?string
    {
        return $this->provinceCode;
    }

    public function setProvinceCode(?string $provinceCode): void
    {
        $this->provinceCode = $provinceCode;
    }

    public function getProvinceName(): ?string
    {
        return $this->provinceName;
    }

    public function setProvinceName(?string $provinceName): void
    {
        $this->provinceName = $provinceName;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): void
    {
        $this->postcode = $postcode;
    }

    public function getRrule(): string
    {
        return $this->rrule;
    }

    public function setRrule(string $rrule): void
    {
        $this->rrule = $rrule;
    }

    public function getOrderPreparationDelay(): int
    {
        return $this->orderPreparationDelay;
    }

    public function setOrderPreparationDelay(int $orderPreparationDelay): void
    {
        $this->orderPreparationDelay = $orderPreparationDelay;
    }

    public function getThroughput(): int
    {
        return $this->throughput;
    }

    public function setThroughput(int $throughput): void
    {
        $this->throughput = $throughput;
    }

    public function isGeneratePin(): bool
    {
        return $this->generatePin;
    }

    public function setGeneratePin(bool $generatePin): void
    {
        $this->generatePin = $generatePin;
    }

    public function getShippingMethods(): Collection
    {
        return $this->shippingMethods;
    }

    public function addShippingMethod(ClickNCollectShippingMethodInterface $shippingMethod): void
    {
        if (!$this->shippingMethods->contains($shippingMethod)) {
            $this->shippingMethods->add($shippingMethod);
        }

        $locations = $shippingMethod->getLocations();
        if (!$locations->contains($this)) {
            $locations->add($this);
        }
    }

    public function removeShippingMethod(ClickNCollectShippingMethodInterface $shippingMethod): void
    {
        $this->shippingMethods->removeElement($shippingMethod);
        $shippingMethod->getLocations()->removeElement($this);
    }
}
