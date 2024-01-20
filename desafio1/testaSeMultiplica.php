<?php
/**
 * @param int $num_lin_A 
 * @param int $num_col_B
 * @return bool
 */
/*
testa se da para multiplicar matrix A pela B,
numcolunas A == numlinhas B, se sim true
 */


function testaSeMultiplica(int $num_lin_A, int $num_col_B)
{
    return $num_lin_A === $num_col_B;
}