<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProyectosInvestigacion extends Model
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
        $id_proyecto,
        $tabla_cambios, //Investigacion_Has_#
        $arrayComparacion, //Array de elementos seleccionados
        $campoGeneral,
        $campoDiffEspecifico, //Llave foranea especifica de cada tabla
        $campoEstado //Campo estado de la tabla
    ) {
        $proyecto = DB::table('proyectos_investigacion')
            ->where('id_p_investigacion', $id_proyecto)
            ->get();
        $array_elementos = DB::table($tabla_cambios)
            ->where($campoGeneral, $proyecto->first()->id_p_investigacion)
            ->get();

        dd($array_elementos);
        $elementos_agregados = array_diff($array_elementos, $arrayComparacion);
        $elementos_eliminados = array_diff($arrayComparacion, $array_elementos);

        foreach ($elementos_agregados as $agregado) {
            if (count(DB::table($tabla_cambios)
                ->where($campoDiffEspecifico, $agregado)->get())) {
                DB::table($tabla_cambios)->where([
                    $campoDiffEspecifico => $agregado,
                    $campoGeneral => $proyecto->first()->id_p_investigacion
                ])->update([$campoEstado => 1]);
            } else {
                DB::table($tabla_cambios)->where($campoGeneral, $proyecto->first()->id_p_investigacion)
                    ->insert([
                        $campoGeneral => $proyecto->first()->id_p_investigacion,
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
        // dd($datos);
        $arrayUnico = [];
        foreach ($datos as $key => $valor) {
            if ($key === 'actividades') {
                foreach ($valor as $llave => $array) {
                    if ($llave == $clave) {
                        if (!isset($arrayUnico[$llave])) {
                            $arrayUnico[$llave] = [];
                        }
                        foreach ($array as $arr => $multiple) {
                            // dd($array);
                            if (is_array($multiple)) {
                                foreach ($multiple as $ky => $val) {
                                    // dd($multiple);
                                    if (!isset($arrayUnico[$llave][$arr])) {
                                        $arrayUnico[$llave][$arr] = [];
                                    }
                                    array_push($arrayUnico[$llave][$arr],);
                                }
                            } else {
                                array_push($arrayUnico[$llave], $multiple);
                            }
                        }
                    }
                }
            }
        }
        dd($arrayUnico);
        return $arrayUnico;
    }

    public function getAnoEjecucion()
    {
        return $this->ano_ejecucion;
    }

    public function getCodigoSigp()
    {
        return $this->codigo_sigp;
    }

    public function getNombreProyecto()
    {
        return $this->nombre_proyecto;
    }

    public function getResumenProyecto()
    {
        return $this->resumen_proyecto;
    }

    public function getObjetivoGeneral()
    {
        return $this->objetivo_general;
    }

    public function getPropuesta()
    {
        return $this->propuesta;
    }

    public function getTipologia()
    {
        return $this->tipologia;
    }

    public function getImpacto()
    {
        return $this->impacto;
    }

    public function getEstadoPInvestigacion()
    {
        return $this->estado_p_investigacion;
    }

    public function setAnoEjecucion($anoEjecucion)
    {
        $this->attributes['ano_ejecucion'] = $anoEjecucion;
    }

    public function setCodigoSigp($codigoSigp)
    {
        $this->attributes['codigo_sigp'] = $codigoSigp;
    }

    public function setNombreProyecto($nombreProyecto)
    {
        $this->attributes['nombre_proyecto'] = $nombreProyecto;
    }

    public function setResumenProyecto($resumenProyecto)
    {
        $this->attributes['resumen_proyecto'] = $resumenProyecto;
    }

    public function setObjetivoGeneral($objetivoGeneral)
    {
        $this->attributes['objetivo_general'] = $objetivoGeneral;
    }

    public function setPropuesta($propuesta)
    {
        $this->attributes['propuesta'] = $propuesta;
    }

    public function setTipologia($tipologia)
    {
        $this->attributes['tipologia'] = $tipologia;
    }

    public function setImpacto($impacto)
    {
        $this->attributes['impacto'] = $impacto;
    }

    public function setEstadoPInvestigacion($estadoPInvestigacion)
    {
        $this->attributes['estado_p_investigacion'] = $estadoPInvestigacion;
    }
}
