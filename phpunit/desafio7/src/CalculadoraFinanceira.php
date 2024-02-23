<?php

class CalculadoraFinanceira 
{

    private static function validarParametros(float $capital, float $tempo): void {
        if ($capital <= 0) {
            throw new InvalidArgumentException("O capital deve ser maior ou igual a zero.");
        }
        if ($tempo <= 0) {
            throw new InvalidArgumentException("O tempo deve ser maior ou igual a zero.");
        }
    }


    public static function calcularJurosSimples(float $capital, float $taxa, float $tempo): float {
        self::validarParametros($capital, $tempo);

        $juros = $capital * $taxa * $tempo;
        return round($juros, 2);
    }

    public static function calcularJurosCompostos(float $capital, float $taxa, float $tempo) {
        self::validarParametros($capital, $tempo);

        $juros = $capital * pow((1 + $taxa), $tempo) - $capital;
        return round($juros, 2);
    }

    public static function calcularAmortizacao(float $capital, float $taxa, float $tempo, $tipo) {
        self::validarParametros($capital, $tempo);

        if (strtolower($tipo) !== 'sac' && strtolower($tipo) !== 'price') {
            throw new InvalidArgumentException("O tipo deve ser 'SAC' ou 'Price'.");
        }

        $resultados = [];
        $jurosTotal = 0;
    
        if (strtolower($tipo) === 'sac') {
            $amortizacao = $capital / $tempo;
            for ($i = 1; $i <= $tempo; $i++) {
                $juros = ($capital - ($amortizacao * ($i - 1))) * $taxa;
                $jurosTotal += $juros;
                $mensalidade = $amortizacao + $juros;
                $resultados['periodo' . $i] = round($mensalidade, 2);
            }
        } elseif (strtolower($tipo) === 'price') {
            $parcela = $capital * $taxa / (1 - pow((1 + $taxa), -$tempo));
            for ($i = 1; $i <= $tempo; $i++) {
                $saldoDevedor = $capital;
                for ($j = 0; $j < $i - 1; $j++) {
                    $jurosMes = $saldoDevedor * $taxa;
                    $saldoDevedor -= ($parcela - $jurosMes);
                }
                $jurosMesAtual = $saldoDevedor * $taxa;
                $jurosTotal += $jurosMesAtual;
                $resultados['periodo' . $i] = round($parcela, 2);
            }
        }
    
        $resultados['jurosTotal'] = round($jurosTotal, 2);
        return $resultados;
    }
}


