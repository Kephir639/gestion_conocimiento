<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class proyectosInvestigacion extends Model
{
    use HasFactory;

    protected $table = 'proyectos_investigacion';
    protected $fillable = [
        'ano_ejecucion',
        'codigo_sigp',
        'nombre_proyecto',
        'resumen_proyecto',
        'objetivo_general',
        'propuesta',
        'tipologia',
        'impacto',
        'estado_p_investigacion'
    ];

    public function actualizarElementos(
        $codigo_proyecto,
        $tabla_cambios, //Investigacion_Has_#
        $arrayComparacion, //Array de elementos seleccionados
        $campoGeneral,
        $campoDiffEspecifico, //Llave foranea especifica de cada tabla
        $campoEstado //Campo estado de la tabla
    ) {
        $proyecto = DB::table('proyectos_investigacion')
            ->where('codigo_sigp', $codigo_proyecto)
            ->get();
        $array_elementos = DB::table($tabla_cambios)
            ->where($campoGeneral, $proyecto->id_p_investigacion)
            ->get()->toArray();

        $elementos_agregados = array_diff($array_elementos, $arrayComparacion);
        $elementos_eliminados = array_diff($arrayComparacion, $array_elementos);

        foreach ($elementos_agregados as $agregado) {
            if (count(DB::table($tabla_cambios)
                ->where($campoDiffEspecifico, $agregado)->get())) {
                DB::table($tabla_cambios)->where([
                    $campoDiffEspecifico => $agregado,
                    $campoGeneral => $proyecto->id_p_investigacion
                ])->update([$campoEstado => 1]);
            } else {
                DB::table($tabla_cambios)->where($campoGeneral, $proyecto->id_p_investigacion)
                    ->insert([
                        $campoGeneral => $proyecto->id_p_investigacion,
                        $campoDiffEspecifico => $agregado,
                        $campoEstado => 1
                    ]);
            }
        }
        foreach ($elementos_eliminados as $eliminado) {
            DB::table($tabla_cambios)->where($campoDiffEspecifico, $eliminado)
                ->update([
                    $campoEstado => 0
                ]);
        }
    }

    public function crearArray($datos, $clave)
    {
        $arrayUnico = [[]];
        foreach ($datos as $key => $valor) {
            if ($key === 'actividades') {
                foreach ($valor as $llave => $array) {
                    if ($llave == $clave) {
                        foreach ($array as $arr => $multiple) {
                            if (is_array($multiple)) {
                                foreach ($multiple as $ky) {
                                    array_push($arrayUnico[$llave], $ky);
                                }
                            } else {
                                array_push($arrayUnico[$llave], $arr);
                            }
                        }
                    }
                }
            }
        }
        return $arrayUnico;
    }
}
