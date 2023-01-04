<?php
namespace console\controllers;

use yii\console\Controller;

class MathController extends Controller
{
    public function actionExpectedValue()
    {
        $distribution = [
            20 => 0.3,
            35 => 0.1,
            17 => 0.15,
            24 => 0.25,
            10 => 0.2
        ];

        $expectedValue = 0;
        foreach ($distribution as $key => $value) {

            $discreteQuantity = $key * $value;
            $expectedValue += $discreteQuantity;
            echo "Дискретна величина {$key} має значення: {$discreteQuantity} \n";
        }
        echo "Математичне очікування: {$expectedValue}\n";

        $expectedValueSquared = 0;

        foreach ($distribution as $key => $value) {

            $discreteQuantitySquared = pow($key, 2) * $value;
            $expectedValueSquared += $discreteQuantitySquared;
        }

        $dispersion = $expectedValueSquared - pow($expectedValue, 2);

        echo "Дисперсія: {$dispersion}\n";

        $extrapolation = 0;
        $n = 3;
        $Yn = 25;
        $Yt = 26;

        $extrapolation = $Yt * bcsqrt($Yt / $Yn, $n - 1);

        echo "Екстерполяція тренду на 2023: {$extrapolation}";
    }
}