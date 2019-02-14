<?php
/**
 * Created by PhpStorm.
 * User: rocher
 * Date: 14/02/19
 * Time: 09:00
 */

namespace App\Validator\Constraints;
use Composer\Semver\Constraint\Constraint;

class ConstraintsCheckPlace extends Constraint
{
    public $message = "Désolé! Il n'y a plus de place";
}
