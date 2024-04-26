<?php

# Chec if inputs are empty.
function is_input_empty($name, $age)
{
    if (empty($name) && empty($age)) {
        return true;
    }
}