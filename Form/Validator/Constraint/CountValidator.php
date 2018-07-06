<?php

namespace Artgris\Bundle\MediaBundle\Form\Validator\Constraint;

use Artgris\Bundle\MediaBundle\Entity\Media;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class CountValidator extends \Symfony\Component\Validator\Constraints\CountValidator
{

    public function validate($value, Constraint $constraint)
    {
        if ($value !== null && $value instanceof Collection) {
            $value = array_filter($value->toArray(), function ($media) {
                return $media !== null && $media instanceof Media && $media->getPath() !== null;
            });
        }

        parent::validate($value, $constraint);
    }

}