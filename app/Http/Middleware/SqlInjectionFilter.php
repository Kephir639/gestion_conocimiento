<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SqlInjectionFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $datos = $request->all();

        unset($datos['controladores']);
        unset($datos['usuariosPendientes']);

        $caracteres = [
            "'",
            "\"",
            "-",
            ";",
            ":",
            ",",
            "(",
            ")",
            "=",
            "<",
            ">",
            "*",
            "%",
            "_",
            "#",
            "$",
            "!",
            "&",
            "|",
            "^",
            "~",
            "\x00",
            "\x01",
            "\x02",
            "\x03",
            "\x04",
            "\x05",
            "\x06",
            "\x07",
            "\x08",
            "\x09",
            "\x0A",
            "\x0B",
            "\x0C",
            "\x0D",
            "\x0E",
            "\x0F",
            "\x10",
            "\x11",
            "\x12",
            "\x13",
            "\x14",
            "\x15",
            "\x16",
            "\x17",
            "\x18",
            "\x19",
            "\x1A",
            "\x1B",
            "\x1C",
            "\x1D",
            "\x1E",
            "\x1F"
        ];
        $datosLimpios = [];


        foreach ($datos as $input => $valor) {
            if (is_array($valor)) {
                foreach ($valor as $key => $arraySimple) {
                    if (is_array($arraySimple)) {
                        foreach ($arraySimple as $keyM => $campoUnico) {
                            if (is_array($campoUnico)) {
                                foreach ($campoUnico as $camp => $campoMultiple)
                                    $datosLimpios[$input][$key][$keyM][$camp] = str_replace($caracteres, "", $campoMultiple);
                            } else {
                                $datosLimpios[$input][$key][$keyM] = str_replace($caracteres, "", $campoUnico);
                            }
                        }
                    } else {
                        $datosLimpios[$input][$key] = str_replace($caracteres, "", $arraySimple);
                    }
                }
            } else {
                $datosLimpios[$input] = str_replace($caracteres, "", $valor);
            }
        }
        $request->replace($datosLimpios);

        return $next($request);
    }
}
