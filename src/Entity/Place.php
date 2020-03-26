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

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Sylius\Component\Resource\Model\ToggleableTrait;

/**
 * {@inheritdoc}
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class Place implements PlaceInterface
{
    use TimestampableTrait;
    use ToggleableTrait;

    /** @var mixed */
    protected $id;
    protected ?string $code = null;
    protected string $name = '';
    protected ?string $street = null;
    protected ?string $city = null;
    protected ?string $postcode = null;
    protected ?string $countryCode = null;
    protected ?string $provinceCode = null;
    protected ?string $provinceName = null;
    protected string $rrule = 'FREQ=MINUTELY;INTERVAL=20;BYHOUR=9,10,11,12,13,14,15,16;BYDAY=MO,TU,WE,TH,FR;DTSTART=20200316T080000;DTEND=29990316T082000';
    protected int $orderPreparationDelay = 0;
    protected int $throughput = 1;
    protected bool $generatePin = false;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
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

    public function getChannels(): Collection
    {
        return $this->channels;
    }

    public function addChannel(ChannelInterface $channel): void
    {
        if (!$this->hasChannel($channel)) {
            $this->channels->add($channel);
        }
    }

    public function hasChannel(ChannelInterface $channel): bool
    {
        return $this->channels->contains($channel);
    }

    public function removeChannel(ChannelInterface $channel): void
    {
        if ($this->hasChannel($channel)) {
            $this->channels->removeElement($channel);
        }
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
}
