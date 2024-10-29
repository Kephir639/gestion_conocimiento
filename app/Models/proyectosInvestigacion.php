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

    /*Esta funcion se encarga de registrar o actualizar los campos multiples segun sea necesario,
    lo hace comparando el array de elementos existentes con el array de items recibido, entonces
    se decide, si es necesario actualizar el estado del registro en la tabla intermedia(en caso de
    que se haya "Eliminado") a inactivo(0), se tenga que registrar en caso de que aun no exista en la BD,
    y tambien cambiar el estado a Activo(1) en caso de que se haya agregado y exista en la BD*/
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
        $elementos = DB::table($tabla_cambios)
            ->where($campoGeneral, $proyecto->first()->id_p_investigacion)
            ->get();
        $array_elementos = [];
        foreach ($elementos as $elemento) {
            array_push($array_elementos, strval($elemento->$campoDiffEspecifico));
        }
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

    /*Esta funcion se encarga re recorrer el array de valores($datos) enviado por el formulario y crear
    un array nuevo que contenga solamente los elementos del array seleccionado($clave), de cada actividad
    o presupuesto*/
    public function crearArray($datos, $clave)
    {
        $arrayUnico = [];
        foreach ($datos as $key => $valor) {
            //Accede a los arrays anidados con las respuestas de los campos dinamicos
            if ($key === 'actividades' || $key === 'presupuestos') {
                foreach ($valor as $llave => $array) {
                    if ($llave == $clave) { //Accede al array de respuestas que necesitamos
                        if (!isset($arrayUnico[$llave])) {
                            $arrayUnico[$llave] = [];
                        }
                        foreach ($array as $arr => $multiple) {
                            if (is_array($multiple)) { //Ingresa si es un array anidado que contiene los campos dinamicos
                                foreach ($multiple as $ky => $val) {
                                    if (!isset($arrayUnico[$llave][$arr])) {
                                        $arrayUnico[$llave][$arr] = [];
                                    }
                                    array_push($arrayUnico[$llave][$arr], $val);
                                }
                            } else { //En caso de ser un campo simple se registran las respuestas en un array
                                array_push($arrayUnico[$llave], $multiple);
                            }
                        }
                    }
                }
            }
        }
        return $arrayUnico;
    }

    /*Realiza el mismo trabajo que la funcion crearArray, solo que, en este caso necesitamos que la clave del
    nuevo array coincida con las claves de la informacion que pasamos, esto porque esas claves son el id correspondiente
    al registro de la BD y con el seremos capaces de determinar si se agrego un elemento nuevo, si se elimino uno existente
    o si se agrego uno que ya exisistia*/
    public function actualizarArray($datos, $clave)
    {
        $arrayUnico = [];
        foreach ($datos as $key => $valor) {
            if ($key === 'actividades' || $key === 'presupuestos') {
                foreach ($valor as $llave => $array) {
                    if ($llave == $clave) {
                        if (!isset($arrayUnico[$llave])) {
                            $arrayUnico[$llave] = [];
                        }
                        foreach ($array as $arr => $multiple) {
                            if (is_array($multiple)) {
                                if (!isset($arrayUnico[$llave][$arr])) {
                                    $arrayUnico[$llave][$arr] = $multiple;
                                }
                            } else {
                                array_push($arrayUnico[$llave], $multiple);
                            }
                        }
                    }
                }
            }
        }
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
