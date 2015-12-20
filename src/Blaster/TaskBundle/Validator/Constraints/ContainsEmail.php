<?php

namespace Blaster\TaskBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsEmail extends Constraint
{
    /**
     * @var string
     */
    public $message = 'Mūsų sistema neleidžia registruoti "%string%"';

    /**
     * @return string
     */
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

}