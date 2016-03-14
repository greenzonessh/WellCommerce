<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\AttributeBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Util\Debug;
use Knp\DoctrineBehaviors\Model\Blameable\Blameable;
use Knp\DoctrineBehaviors\Model\Timestampable\Timestampable;
use Knp\DoctrineBehaviors\Model\Translatable\Translatable;
use WellCommerce\Bundle\DoctrineBundle\Entity\AbstractEntity;

/**
 * Class AttributeGroup
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class AttributeGroup extends AbstractEntity implements AttributeGroupInterface
{
    use Translatable;
    use Timestampable;
    use Blameable;

    /**
     * @var Collection
     */
    protected $attributes;

    /**
     * {@inheritdoc}
     */
    public function getAttributes() : Collection
    {
        return $this->attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributes(Collection $attributes)
    {
        if ($this->attributes instanceof Collection) {
            $this->attributes->map(function (AttributeInterface $attribute) use ($attributes) {
                if (false === $attributes->contains($attribute)) {
                    $this->removeAttribute($attribute);
                }
            });
        }

        $this->attributes = $attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function removeAttribute(AttributeInterface $attribute)
    {
        $this->attributes->removeElement($attribute);
    }

    /**
     * {@inheritdoc}
     */
    public function addAttribute(AttributeInterface $attribute)
    {
        $this->attributes->add($attribute);
    }
}