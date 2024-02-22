<?php

class CalculadoraFinanceira {
    public function calcularJurosSimples($capital, $taxa, $tempo) {
        return $capital * $taxa * $tempo;
    }

    public function calcularJurosCompostos($capital, $taxa, $tempo) {
        return $capital * pow((1 + $taxa), $tempo) - $capital;
    }

    public function calcularAmortizacao($capital, $taxa, $tempo, $tipo) {
        // Implementação simplificada, detalhes dependem do sistema de amortização específico
        $resultados = [];
        if ($tipo === 'SAC') {
            // Lógica para SAC
            $amortizacao = $capital / $tempo;
            for ($i = 1; $i <= $tempo; $i++) {
                $juros = ($capital - ($amortizacao * ($i - 1))) * $taxa;
                $resultados[] = ['amortizacao' => $amortizacao, 'juros' => $juros];
            }
        } elseif ($tipo === 'Price') {
            // Lógica para Price
            $juros = $capital * $taxa / (1 - pow((1 + $taxa), -$tempo));
            for ($i = 1; $i <= $tempo; $i++) {
                $resultados[] = ['parcela' => $juros];
            }
        }
        return $resultados;
    }
}
