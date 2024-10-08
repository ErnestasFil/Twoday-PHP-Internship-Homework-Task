<?php

class RuleFactory
{
    public static function make(string $rule): mixed
    {
        [$ruleName, $parameters] = self::parseRule($rule);
        if (!empty($parameters))
            $parametersArray = explode(':', $parameters);

        $type = null;
        $parameter = null;

        if (!empty($parametersArray)) {
            $type = $parametersArray[0] ?? null;
            $parameter = $parametersArray[1] ?? null;
        }

        $className = ucfirst($ruleName) . 'Rule';

        if (!class_exists($className)) {
            throw new Exception("Validation rule $ruleName does not exist." . PHP_EOL);
        }
        return new $className($type, $parameter);
    }

    private static function parseRule(string $rule): array
    {
        if (str_contains($rule, ':')) {
            return explode(':', $rule, 2);
        }
        return [$rule, null];
    }
}

