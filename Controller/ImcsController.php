<?php
 
namespace Controller;
 
use Model\Imcs;
use Exception;
 
class ImcsController
{
    private $imcModel;
 
    public function __construct()
    {
        $this->imcModel = new Imcs();
    }
 
    /**
     * Calcula o IMC e retorna um array com resultado e classificação, ou string em caso de erro
     */
    public function calculateIMC($weight, $height): array|string
    {
        try {
            if (isset($weight) && isset($height)) {
                if ($weight > 0 && $height > 0) {
                    $imc = round($weight / ($height * $height), 2);
                    $result = ["imc" => $imc];
 
                    switch (true) {
                        case ($imc < 18.5):
                            $result["BMIrange"] = "Baixo Peso";
                            break;
                        case ($imc >= 18.5 && $imc < 25):
                            $result["BMIrange"] = "Peso Normal";
                            break;
                        case ($imc >= 25 && $imc < 30):
                            $result["BMIrange"] = "Sobrepeso";
                            break;
                        case ($imc >= 30 && $imc < 35):
                            $result["BMIrange"] = "Obesidade Grau I";
                            break;
                        case ($imc >= 35 && $imc < 40):
                            $result["BMIrange"] = "Obesidade Grau II";
                            break;
                        default:
                            $result["BMIrange"] = "Obesidade Grau III";
                            break;
                    }
 
                    return $result;
                } else {
                    return "Por favor, informe valores maiores que zero para Peso e Altura.";
                }
            } else {
                return "Por favor, informe seu Peso e Altura.";
            }
        } catch (Exception $e) {
            return "Erro ao calcular o IMC: " . $e->getMessage();
        }
    }
 
    /**
     * Salva o IMC no banco
     */
    public function saveIMC($weight, $height, $imcResult): bool
    {
        return $this->imcModel->createImc($weight, $height, $imcResult);
    }
}
?>
 
 