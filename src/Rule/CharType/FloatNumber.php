<?php
/*
 * This file is part of Phypes <https://github.com/2DSharp/Phypes>.
 *
 * (c) Dedipyaman Das <2d@twodee.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Phypes\Rule\Number;


use Phypes\Error\RuleError;
use Phypes\Error\RuleErrorCode;
use Phypes\Result\Failure;
use Phypes\Result\Result;
use Phypes\Result\Success;
use Phypes\Rule\CharType\CharType;
use Phypes\Rule\Primitive\NumericType;
use Phypes\Rule\Rule;

class FloatNumber extends CharType implements Rule
{
    public function validate($value): Result
    {
        $numericResult = (new NumericType())->validate($value);

        if (!$numericResult->isValid())
            return new $numericResult;

        if (filter_var(str_replace($this->allowedSpecialChars, '', $value), FILTER_VALIDATE_FLOAT) !== false) {
            return new Success();
        }
        return new Failure(new RuleError(RuleErrorCode::NOT_FLOAT, 'Value is not float.'));
    }
}
